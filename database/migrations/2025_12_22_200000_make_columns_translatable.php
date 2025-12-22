<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Convert existing string data to JSON format with French locale.
     */
    private function convertToJsonLocale(string $table, array $columns): void
    {
        $records = DB::table($table)->get();

        foreach ($records as $record) {
            $updates = [];
            foreach ($columns as $column) {
                $value = $record->$column;
                if ($value !== null && !$this->isJson($value)) {
                    $updates[$column] = json_encode(['fr' => $value]);
                }
            }
            if (!empty($updates)) {
                DB::table($table)->where('id', $record->id)->update($updates);
            }
        }
    }

    /**
     * Check if a string is valid JSON.
     */
    private function isJson(?string $string): bool
    {
        if ($string === null) {
            return false;
        }
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert existing data to JSON format first
        $this->convertToJsonLocale('products', ['name', 'description', 'short_description']);
        $this->convertToJsonLocale('posts', ['title', 'excerpt', 'content', 'meta_title', 'meta_description']);
        $this->convertToJsonLocale('categories', ['name', 'description']);
        $this->convertToJsonLocale('partners', ['name', 'description']);
        $this->convertToJsonLocale('process_steps', ['title', 'description']);
        $this->convertToJsonLocale('pages', ['title', 'meta_description']);

        // Products table
        Schema::table('products', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
            $table->json('short_description')->nullable()->change();
        });

        // Posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('excerpt')->nullable()->change();
            $table->json('content')->nullable()->change();
            $table->json('meta_title')->nullable()->change();
            $table->json('meta_description')->nullable()->change();
        });

        // Categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });

        // Partners table
        Schema::table('partners', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });

        // Process Steps table
        Schema::table('process_steps', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->nullable()->change();
        });

        // Pages table
        Schema::table('pages', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('meta_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Products table
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('description')->nullable()->change();
            $table->text('short_description')->nullable()->change();
        });

        // Posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('excerpt')->nullable()->change();
            $table->longText('content')->nullable()->change();
            $table->string('meta_title')->nullable()->change();
            $table->text('meta_description')->nullable()->change();
        });

        // Categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('description')->nullable()->change();
        });

        // Partners table
        Schema::table('partners', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('description')->nullable()->change();
        });

        // Process Steps table
        Schema::table('process_steps', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->nullable()->change();
        });

        // Pages table
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('meta_description')->nullable()->change();
        });
    }
};
