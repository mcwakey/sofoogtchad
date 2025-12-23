<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class VersionService
{
    /**
     * Cache duration in seconds (1 hour in production, no cache in dev)
     */
    protected int $cacheDuration = 3600;

    /**
     * Get the current application version.
     *
     * @return array{version: string, tag: string|null, branch: string|null, is_stable: bool}
     */
    public function getVersionInfo(): array
    {
        if (app()->environment('local', 'development', 'testing')) {
            return $this->resolveVersionInfo();
        }

        return Cache::remember('app_version_info', $this->cacheDuration, function () {
            return $this->resolveVersionInfo();
        });
    }

    /**
     * Get just the version string.
     */
    public function getVersion(): string
    {
        return $this->getVersionInfo()['version'];
    }

    /**
     * Get formatted version display string.
     * Example: "v1.0.0 (stable)" or "dev-main"
     */
    public function getFormattedVersion(): string
    {
        $info = $this->getVersionInfo();

        if ($info['is_stable']) {
            return "v{$info['version']} (stable)";
        }

        if ($info['branch']) {
            return "dev-{$info['branch']}";
        }

        return $info['version'];
    }

    /**
     * Check if the current version is stable (from a tag).
     */
    public function isStable(): bool
    {
        return $this->getVersionInfo()['is_stable'];
    }

    /**
     * Clear the cached version info.
     */
    public function clearCache(): void
    {
        Cache::forget('app_version_info');
    }

    /**
     * Resolve the version info from Git.
     */
    protected function resolveVersionInfo(): array
    {
        $tag = $this->getLatestTag();
        $branch = $this->getCurrentBranch();

        // Check if we're exactly on a tag
        $isOnTag = $this->isExactlyOnTag();

        if ($isOnTag && $tag) {
            return [
                'version' => $this->normalizeTag($tag),
                'tag' => $tag,
                'branch' => $branch,
                'is_stable' => true,
            ];
        }

        // Not on a tag - development version
        if ($tag) {
            // We have tags, but we're not exactly on one
            return [
                'version' => $this->normalizeTag($tag) . '-dev',
                'tag' => $tag,
                'branch' => $branch,
                'is_stable' => false,
            ];
        }

        // No tags at all
        return [
            'version' => 'dev',
            'tag' => null,
            'branch' => $branch,
            'is_stable' => false,
        ];
    }

    /**
     * Get the latest Git tag.
     */
    protected function getLatestTag(): ?string
    {
        $tag = $this->executeGitCommand('describe --tags --abbrev=0 2>&1');

        if ($tag && !str_contains($tag, 'fatal:')) {
            return trim($tag);
        }

        return null;
    }

    /**
     * Get the current Git branch.
     */
    protected function getCurrentBranch(): ?string
    {
        $branch = $this->executeGitCommand('rev-parse --abbrev-ref HEAD 2>&1');

        if ($branch && !str_contains($branch, 'fatal:')) {
            return trim($branch);
        }

        return null;
    }

    /**
     * Check if we're exactly on a tagged commit.
     */
    protected function isExactlyOnTag(): bool
    {
        $result = $this->executeGitCommand('describe --exact-match --tags HEAD 2>&1');

        return $result && !str_contains($result, 'fatal:');
    }

    /**
     * Normalize tag to version format (strip 'v' prefix if present).
     */
    protected function normalizeTag(string $tag): string
    {
        return ltrim($tag, 'vV');
    }

    /**
     * Execute a Git command and return the output.
     */
    protected function executeGitCommand(string $command): ?string
    {
        $basePath = base_path();

        // Check if we're in a Git repository
        if (!is_dir($basePath . '/.git')) {
            return null;
        }

        $fullCommand = "cd \"{$basePath}\" && git {$command}";

        $output = shell_exec($fullCommand);

        return $output ?: null;
    }

    /**
     * Get changelog entries for the current version.
     */
    public function getChangelogForVersion(?string $version = null): ?array
    {
        $version = $version ?? $this->getVersion();
        $changelogPath = base_path('CHANGELOG.md');

        if (!file_exists($changelogPath)) {
            return null;
        }

        $content = file_get_contents($changelogPath);
        $pattern = '/## \[' . preg_quote($version, '/') . '\].*?\n(.*?)(?=\n## \[|$)/s';

        if (preg_match($pattern, $content, $matches)) {
            return $this->parseChangelogSection($matches[1]);
        }

        return null;
    }

    /**
     * Parse a changelog section into structured data.
     */
    protected function parseChangelogSection(string $section): array
    {
        $result = [];
        $currentType = null;
        $lines = explode("\n", trim($section));

        foreach ($lines as $line) {
            $line = trim($line);

            if (preg_match('/^### (.+)$/', $line, $matches)) {
                $currentType = strtolower($matches[1]);
                $result[$currentType] = [];
            } elseif ($currentType && preg_match('/^- (.+)$/', $line, $matches)) {
                $result[$currentType][] = $matches[1];
            }
        }

        return $result;
    }

    /**
     * Validate that the current version exists in CHANGELOG.md.
     */
    public function validateChangelogAlignment(): array
    {
        $info = $this->getVersionInfo();
        $errors = [];

        if (!$info['is_stable']) {
            return ['valid' => true, 'errors' => [], 'warnings' => ['Not on a stable version, changelog validation skipped.']];
        }

        $changelogPath = base_path('CHANGELOG.md');

        if (!file_exists($changelogPath)) {
            $errors[] = 'CHANGELOG.md file not found.';
            return ['valid' => false, 'errors' => $errors, 'warnings' => []];
        }

        $content = file_get_contents($changelogPath);
        $version = $info['version'];

        if (!preg_match('/## \[' . preg_quote($version, '/') . '\]/', $content)) {
            $errors[] = "Version {$version} not found in CHANGELOG.md.";
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
            'warnings' => [],
        ];
    }
}
