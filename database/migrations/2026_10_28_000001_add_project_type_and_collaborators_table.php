<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom project_type ke tabel projects
        Schema::table('projects', function (Blueprint $table) {
            $table->string('project_type')->default('individu')->after('category_label'); // individu | kolaborasi
        });

        // Tabel anggota kolaborasi
        Schema::create('project_collaborators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name');           // Nama anggota
            $table->string('nim')->nullable(); // NIM anggota (opsional)
            $table->string('jobdesk');         // Peran / job description
            $table->integer('order')->default(0); // Urutan tampil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_collaborators');
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('project_type');
        });
    }
};
