<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('MASUK KE DASHBOARD');
    }

    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('DAFTAR AKUN MAHASISWA');
    }

    public function test_new_mahasiswa_can_register_with_valid_nim(): void
    {
        $response = $this->post('/register', [
            'name' => 'Fajar Pratama',
            'nim' => '2201990011',
            'prodi' => 'Teknik Informatika',
            'email' => 'fajar@mahasiswa.ac.id',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('mahasiswa.dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'fajar@mahasiswa.ac.id',
            'nim' => '2201990011',
            'role' => 'mahasiswa',
        ]);
    }

    public function test_registration_fails_if_nim_is_duplicate(): void
    {
        User::factory()->create([
            'nim' => '2201990011',
            'email' => 'existing@mahasiswa.ac.id',
        ]);

        $response = $this->post('/register', [
            'name' => 'Duplicate Mahasiswa',
            'nim' => '2201990011',
            'prodi' => 'Sistem Informasi',
            'email' => 'unique@mahasiswa.ac.id',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertSessionHasErrors(['nim']);
        $this->assertGuest();
    }

    public function test_mahasiswa_can_login_using_email(): void
    {
        $user = User::factory()->mahasiswa()->create([
            'email' => 'karina@mahasiswa.ac.id',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'login' => 'karina@mahasiswa.ac.id',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('mahasiswa.dashboard'));
    }

    public function test_mahasiswa_can_login_using_nim(): void
    {
        $user = User::factory()->mahasiswa()->create([
            'nim' => '2201010045',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'login' => '2201010045',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('mahasiswa.dashboard'));
    }

    public function test_admin_is_redirected_to_admin_dashboard_upon_login(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@kampus.ac.id',
            'password' => bcrypt('admin123'),
        ]);

        $response = $this->post('/login', [
            'login' => 'admin@kampus.ac.id',
            'password' => 'admin123',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_mahasiswa_accessing_admin_dashboard_is_safely_redirected(): void
    {
        $mahasiswa = User::factory()->mahasiswa()->create();

        $response = $this->actingAs($mahasiswa)->get('/admin/dashboard');

        $response->assertRedirect(route('mahasiswa.dashboard'));
        $response->assertSessionHas('error');
    }

    public function test_user_can_logout_and_session_is_invalidated(): void
    {
        $user = User::factory()->mahasiswa()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('home'));
    }
}
