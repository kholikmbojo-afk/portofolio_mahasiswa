<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Administrator Resmi Kampus
        $admin = User::updateOrCreate(
            ['email' => 'admin@kampus.ac.id'],
            [
                'name' => 'Administrator Kurasi Kampus',
                'role' => 'admin',
                'nim' => 'ADM-001',
                'prodi' => 'Lembaga Kurasi & Inovasi Mahasiswa',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Akun Mahasiswa Contoh 1 (Karina Putri)
        $mhs1 = User::updateOrCreate(
            ['email' => 'karina@mahasiswa.ac.id'],
            [
                'name' => 'Karina Putri',
                'role' => 'mahasiswa',
                'nim' => '2201010045',
                'prodi' => 'Desain Komunikasi Visual',
                'password' => Hash::make('mahasiswa123'),
            ]
        );

        // Akun Mahasiswa Contoh 2 (Dimas Wicaksono)
        $mhs2 = User::updateOrCreate(
            ['email' => 'dimas@mahasiswa.ac.id'],
            [
                'name' => 'Dimas Wicaksono',
                'role' => 'mahasiswa',
                'nim' => '2102010112',
                'prodi' => 'Teknik Elektro',
                'password' => Hash::make('mahasiswa123'),
            ]
        );

        // 3. Proyek Unggulan (Approved / ACC)
        Project::updateOrCreate(
            ['title' => 'FinTrack: Finansial Pintar Mahasiswa'],
            [
                'user_id' => $mhs1->id,
                'category' => 'desain',
                'category_label' => 'Desain & UI/UX',
                'description' => 'Rancangan antarmuka dan interaksi berbasis Human-Centered Design untuk aplikasi pengelolaan uang saku mahasiswa dengan visualisasi toples alokasi dana, gamifikasi target tabungan, dan skor kepuasan pengujian 89/100.',
                'tech_stack' => 'Figma, Design Thinking, Design System, Maze Usability',
                'demo_url' => 'https://figma.com',
                'github_url' => 'https://github.com',
                'status' => 'approved',
                'likes_count' => 184,
                'is_featured' => true,
            ]
        );

        Project::updateOrCreate(
            ['title' => 'LogiFlow: Logistik UMKM Terintegrasi'],
            [
                'user_id' => $mhs1->id,
                'category' => 'website',
                'category_label' => 'Website & Web App',
                'description' => 'Aplikasi web end-to-end yang memadukan pencatatan gudang multi-cabang, barcode scanning realtime, dan cek tarif kurir otomatis khusus pelaku usaha UMKM daerah.',
                'tech_stack' => 'Laravel 11, Vue 3, Pinia, MySQL, Tailwind',
                'demo_url' => 'https://demo.logiflow.id',
                'github_url' => 'https://github.com/logiflow',
                'status' => 'approved',
                'likes_count' => 215,
                'is_featured' => true,
            ]
        );

        Project::updateOrCreate(
            ['title' => 'SmartTani: Otomasi Irigasi LoRa Jarak Jauh'],
            [
                'user_id' => $mhs2->id,
                'category' => 'iot',
                'category_label' => 'IoT & Robotika',
                'description' => 'Sistem IoT terdistribusi untuk pertanian lahan kering yang mengintegrasikan sensor kelembaban tanah dan NPK dengan modul transmisi LoRaWAN berdaya rendah (jangkauan 4 km). Mengendalikan katup air otomatis sesuai ambang kekeringan.',
                'tech_stack' => 'ESP32, LoRaWAN, MQTT, Node-RED, C++',
                'demo_url' => 'https://smarttani.io',
                'github_url' => 'https://github.com/smarttani',
                'status' => 'approved',
                'likes_count' => 198,
                'is_featured' => true,
            ]
        );

        Project::updateOrCreate(
            ['title' => 'Nusantara Lore: Rekreasi Visual Cerita Rakyat'],
            [
                'user_id' => $mhs1->id,
                'category' => 'seni',
                'category_label' => 'Seni & Ilustrasi',
                'description' => 'Serial karya seni ilustrasi digital karakter mitologi dan legenda nusantara dengan pendekatan artistik kontemporer beresolusi tinggi untuk melestarikan warisan sastra lisan Indonesia.',
                'tech_stack' => 'Procreate, Photoshop, Digital Painting, Wacom Intuos',
                'demo_url' => 'https://artstation.com',
                'github_url' => null,
                'status' => 'approved',
                'likes_count' => 142,
                'is_featured' => false,
            ]
        );

        Project::updateOrCreate(
            ['title' => 'Jejak Pesisir: Narasi Visual Nelayan Tradisional'],
            [
                'user_id' => $mhs2->id,
                'category' => 'fotografi',
                'category_label' => 'Fotografis & Sinema',
                'description' => 'Dokumentasi esai foto dan sinematografi etnografi mengenai ketangguhan kehidupan para nelayan pesisir utara dalam menghadapi perubahan iklim ekstrem dan modernisasi industri maritim.',
                'tech_stack' => 'Sony Alpha, Lightroom Classic, Color Grading, Cinematography',
                'demo_url' => 'https://vimeo.com',
                'github_url' => null,
                'status' => 'approved',
                'likes_count' => 167,
                'is_featured' => false,
            ]
        );

        Project::updateOrCreate(
            ['title' => 'MediCare: Konsultasi Psikologi Remaja'],
            [
                'user_id' => $mhs1->id,
                'category' => 'mobile',
                'category_label' => 'Aplikasi Mobile',
                'description' => 'Aplikasi mobile pendamping kesehatan mental yang menyediakan ruang konseling aman terenkripsi dengan psikolog kampus, tracker suasana hati, dan komunitas sebaya termoderasi.',
                'tech_stack' => 'Flutter, Dart, Firebase Auth, Cloud Firestore, WebRTC',
                'demo_url' => 'https://play.google.com',
                'github_url' => 'https://github.com/medicare',
                'status' => 'approved',
                'likes_count' => 176,
                'is_featured' => false,
            ]
        );

        // 4. Proyek yang Baru Diunggah Mahasiswa (Menunggu Review / Pending)
        Project::updateOrCreate(
            ['title' => 'EduRobo: Kit Robotika Sederhana untuk SD'],
            [
                'user_id' => $mhs2->id,
                'category' => 'iot',
                'category_label' => 'IoT & Robotika',
                'description' => 'Kit pembelajaran robotika ramah anak yang dapat diprogram menggunakan blok visual Scratch, mengajarkan logika algoritma sejak dini.',
                'tech_stack' => 'Arduino Nano, Scratch 3.0, 3D Printed Chassis',
                'demo_url' => 'https://edurobo.id',
                'github_url' => 'https://github.com/edurobo',
                'status' => 'pending',
                'likes_count' => 12,
                'is_featured' => false,
            ]
        );

        Project::updateOrCreate(
            ['title' => 'EcoBatik: Pewarna Alami Limbah Kulit Buah'],
            [
                'user_id' => $mhs1->id,
                'category' => 'riset',
                'category_label' => 'Riset & Sains Terapan',
                'description' => 'Ekstraksi zat warna tekstil alami dari limbah kulit manggis dan jengkol untuk mereduksi limbah kimia sintetis pada industri batik rumahan.',
                'tech_stack' => 'Ekstraksi Soxhlet, Kolorimetri, Uji Ketahanan Luntur',
                'demo_url' => null,
                'github_url' => null,
                'status' => 'pending',
                'likes_count' => 8,
                'is_featured' => false,
            ]
        );
    }
}
