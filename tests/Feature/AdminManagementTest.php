<?php

namespace Tests\Feature;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin CodingKids',
            'email' => 'admin@codingkids.id',
            'password' => Hash::make('admin123'),
        ]);
    }

    public function test_guest_cannot_access_admin_dashboard_or_reports(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
        $this->get('/admin/peserta')->assertRedirect(route('admin.login'));
        $this->get('/admin/laporan')->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@codingkids.id',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_admin_can_view_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Ringkasan & Dashboard');
    }

    public function test_admin_can_view_participants_list_and_filter(): void
    {
        Registration::create([
            'full_name' => 'Peserta SD Hebat',
            'birth_date' => '2016-01-01',
            'category' => 'sd',
            'school' => 'SD Harapan Bangsa',
            'parent_name' => 'Orang Tua Hebat',
            'parent_phone' => '081234567890',
            'address' => 'Jakarta Selatan',
            'registered_at' => now(),
        ]);

        Registration::create([
            'full_name' => 'Peserta SMP Pintar',
            'birth_date' => '2012-02-02',
            'category' => 'smp',
            'school' => 'SMP Cerdas Jaya',
            'parent_name' => 'Orang Tua Pintar',
            'parent_phone' => '081234567899',
            'address' => 'Jakarta Pusat',
            'registered_at' => now(),
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/peserta');
        $response->assertStatus(200);
        $response->assertSee('Peserta SD Hebat');
        $response->assertSee('Peserta SMP Pintar');

        // Filter SD
        $responseSd = $this->actingAs($this->admin)->get('/admin/peserta?category=sd');
        $responseSd->assertSee('Peserta SD Hebat');
        $responseSd->assertDontSee('Peserta SMP Pintar');
    }

    public function test_admin_can_edit_and_update_participant(): void
    {
        $reg = Registration::create([
            'full_name' => 'Peserta Lama',
            'birth_date' => '2015-05-05',
            'category' => 'sd',
            'school' => 'SD Lama',
            'parent_name' => 'Ortu Lama',
            'parent_phone' => '081211223344',
            'address' => 'Alamat Lama',
            'registered_at' => now(),
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.peserta.update', $reg->id), [
            'full_name' => 'Peserta Baru Diperbarui',
            'birth_date' => '2015-05-05',
            'category' => 'smp',
            'school' => 'SMP Baru Unggulan',
            'parent_name' => 'Ortu Baru',
            'parent_phone' => '081299887766',
            'address' => 'Alamat Baru Lengkap',
        ]);

        $response->assertRedirect(route('admin.peserta.show', $reg->id));

        $this->assertDatabaseHas('registrations', [
            'id' => $reg->id,
            'full_name' => 'Peserta Baru Diperbarui',
            'category' => 'smp',
            'school' => 'SMP Baru Unggulan',
        ]);
    }

    public function test_admin_can_delete_participant(): void
    {
        $reg = Registration::create([
            'full_name' => 'Peserta Akan Dihapus',
            'birth_date' => '2016-06-06',
            'category' => 'sd',
            'school' => 'SD Hapus',
            'parent_name' => 'Ortu Hapus',
            'parent_phone' => '081200000000',
            'address' => 'Alamat Hapus',
            'registered_at' => now(),
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.peserta.destroy', $reg->id));
        $response->assertRedirect(route('admin.peserta.index'));

        $this->assertDatabaseMissing('registrations', [
            'id' => $reg->id,
        ]);
    }

    public function test_admin_can_access_reports_and_exports(): void
    {
        $responseReport = $this->actingAs($this->admin)->get('/admin/laporan');
        $responseReport->assertStatus(200);
        $responseReport->assertSee('Laporan Peserta');

        $responseCsv = $this->actingAs($this->admin)->get('/admin/laporan/export/csv');
        $responseCsv->assertStatus(200);
        $responseCsv->assertHeader('content-type', 'text/csv; charset=UTF-8');

        $responseExcel = $this->actingAs($this->admin)->get('/admin/laporan/export/excel');
        $responseExcel->assertStatus(200);
        $responseExcel->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $responsePrint = $this->actingAs($this->admin)->get('/admin/laporan/print');
        $responsePrint->assertStatus(200);
        $responsePrint->assertSee('Laporan Pendaftaran CodingKids');
    }
}
