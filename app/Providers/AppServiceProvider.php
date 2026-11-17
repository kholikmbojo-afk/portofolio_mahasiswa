<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pastikan kolom avatar_url dan profil di tabel users selalu tersedia
        if (Schema::hasTable('users')) {
            $userColumns = [
                'avatar_url'   => 'string',
                'bio'          => 'text',
                'phone'        => 'string',
                'linkedin_url' => 'string',
                'github_url'   => 'string',
                'angkatan'     => 'string',
            ];
            foreach ($userColumns as $col => $type) {
                if (!Schema::hasColumn('users', $col)) {
                    Schema::table('users', function (Blueprint $table) use ($col, $type) {
                        if ($type === 'text') {
                            $table->text($col)->nullable();
                        } else {
                            $table->string($col)->nullable();
                        }
                    });
                }
            }
        }
    }
}

