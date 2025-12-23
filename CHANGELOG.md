# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Automatic version management system based on Git tags
- Version display in admin panel footer and dashboard header
- `app_version()` helper function for accessing version info
- `VersionService` class for version resolution and caching
- CHANGELOG.md following Keep a Changelog format

### Changed
- Updated admin layout footer to display version information
- Updated dashboard header to show version badge with stable/dev indicator

## [1.0.0] - YYYY-MM-DD

### Added
- Initial release of Sofoodtchad website
- Multi-language support (French, English, Arabic)
- Product catalog with categories and sizes
- Partner showcase section
- Blog/News system with posts and images
- Contact form and distributor request system
- Admin panel with full CRUD functionality
- Hero slider with multiple slides support
- Scroll-aware transparent navbar
- Responsive design with Tailwind CSS
- Media library management
- Page and section management
- Settings management system
- User roles and permissions

### Security
- Laravel Sanctum for API authentication
- CSRF protection
- Input validation and sanitization

---

## Version Naming Convention

- **Major version (X.0.0)**: Breaking changes or major feature releases
- **Minor version (0.X.0)**: New features, backward compatible
- **Patch version (0.0.X)**: Bug fixes and minor improvements

## How to Release a New Version

1. Update this CHANGELOG.md with all changes under `[Unreleased]`
2. Change `[Unreleased]` to the new version number and add the date
3. Add a new `[Unreleased]` section at the top
4. Commit the changes: `git commit -am "Release vX.Y.Z"`
5. Create a Git tag: `git tag vX.Y.Z`
6. Push with tags: `git push origin main --tags`

The version will be automatically detected and displayed in the admin panel.
