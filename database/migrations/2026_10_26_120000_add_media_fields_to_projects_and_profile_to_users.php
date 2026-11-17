<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('youtube_url')->nullable()->after('github_url');
            $table->string('drive_url')->nullable()->after('youtube_url');
            $table->unsignedInteger('views_count')->default(0)->after('likes_count');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_url')->nullable()->after('prodi');
            $table->string('bio')->nullable()->after('avatar_url');
            $table->string('phone')->nullable()->after('bio');
            $table->string('linkedin_url')->nullable()->after('phone');
            $table->string('github_url')->nullable()->after('linkedin_url');
            $table->string('angkatan')->nullable()->after('github_url');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['youtube_url', 'drive_url', 'views_count']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar_url', 'bio', 'phone', 'linkedin_url', 'github_url', 'angkatan']);
        });
    }
};
