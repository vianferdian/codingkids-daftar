<?php

namespace Tests\Feature;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_can_be_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('CODING');
        $response->assertSee('KIDS');
        $response->assertSee('Code &amp; Play', false);
        $response->assertSee('Code &amp; Explore', false);
        $response->assertSee('125rb');
        $response->assertSee('250rb');
    }

    public function test_registration_form_for_sd_and_smp_can_be_rendered(): void
    {
        $responseSd = $this->get('/daftar/sd');
        $responseSd->assertStatus(200);
        $responseSd->assertSee('Code &amp; Play (SD)', false);
        $responseSd->assertSee('125rb');

        $responseSmp = $this->get('/daftar/smp');
        $responseSmp->assertStatus(200);
        $responseSmp->assertSee('Code &amp; Explore (SMP)', false);
        $responseSmp->assertSee('125rb');
    }

    public function test_invalid_category_returns_404(): void
    {
        $response = $this->get('/daftar/sma');
        $response->assertStatus(404);
    }

    public function test_registration_validation_fails_with_invalid_data(): void
    {
        $response = $this->post('/daftar', [
            'full_name' => 'Al',
            'birth_date' => 'invalid-date',
            'category' => 'invalid',
            'school' => '',
            'parent_name' => '',
            'parent_phone' => '12345',
            'address' => '',
        ]);

        $response->assertSessionHasErrors([
            'full_name',
            'birth_date',
            'category',
            'school',
            'parent_name',
            'parent_phone',
            'address',
            'agreement',
        ]);
    }

    public function test_successful_registration_stores_data_and_redirects(): void
    {
        $payload = [
            'full_name' => 'Muhammad Rayhan Pratama',
            'birth_date' => '2016-05-15',
            'category' => 'sd',
            'school' => 'SDIT Nurul Fikri',
            'parent_name' => 'Bambang Pratama',
            'parent_phone' => '081289123456',
            'address' => 'Jl. Kelapa Gading Raya No. 10 Jakarta Utara',
            'agreement' => '1',
        ];

        $response = $this->post('/daftar', $payload);

        $this->assertDatabaseHas('registrations', [
            'full_name' => 'Muhammad Rayhan Pratama',
            'category' => 'sd',
            'school' => 'SDIT Nurul Fikri',
            'parent_phone' => '081289123456',
        ]);

        $registration = Registration::where('full_name', 'Muhammad Rayhan Pratama')->first();
        $this->assertNotNull($registration);

        $response->assertRedirect(route('public.success', $registration->id));

        $successPage = $this->get(route('public.success', $registration->id));
        $successPage->assertStatus(200);
        $successPage->assertSee('Muhammad Rayhan Pratama');
    }

    public function test_print_slip_page_can_be_rendered(): void
    {
        $registration = Registration::create([
            'full_name' => 'Aisyah Putri Azzahra',
            'birth_date' => '2015-08-25',
            'category' => 'sd',
            'school' => 'SD Labschool',
            'parent_name' => 'Hendra Wijaya',
            'parent_phone' => '081377889900',
            'address' => 'Jl. Pemuda No. 45 Jakarta Timur',
            'registered_at' => now(),
        ]);

        $response = $this->get(route('public.print-slip', $registration->id));
        $response->assertStatus(200);
        $response->assertSee('Aisyah Putri Azzahra');
    }
}
