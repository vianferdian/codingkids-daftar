<?php

namespace Database\Seeders;

use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyParticipants = [
            // Kategori SD
            [
                'full_name' => 'Muhammad Rayhan Pratama',
                'birth_date' => '2016-04-12',
                'category' => 'sd',
                'school' => 'SDIT Nurul Fikri',
                'parent_name' => 'Bambang Pratama, S.T.',
                'parent_phone' => '081289123456',
                'address' => 'Jl. Boulevard Raya Blok A4 No. 12, Kelapa Gading, Jakarta Utara',
                'days_ago' => 5,
            ],
            [
                'full_name' => 'Aisyah Putri Azzahra',
                'birth_date' => '2015-08-25',
                'category' => 'sd',
                'school' => 'SD Labschool Rawamangun',
                'parent_name' => 'Dr. Hendra Wijaya',
                'parent_phone' => '081377889900',
                'address' => 'Jl. Pemuda No. 45, Rawamangun, Jakarta Timur',
                'days_ago' => 4,
            ],
            [
                'full_name' => 'Kenzo Jonathan Tan',
                'birth_date' => '2017-02-10',
                'category' => 'sd',
                'school' => 'SD Tarakanita 1 Jakarta',
                'parent_name' => 'David Tanujaya',
                'parent_phone' => '081988223344',
                'address' => 'Komp. Green Garden Blok B2 No. 8, Kedoya, Jakarta Barat',
                'days_ago' => 3,
            ],
            [
                'full_name' => 'Nabila Syakira Hidayat',
                'birth_date' => '2016-11-03',
                'category' => 'sd',
                'school' => 'SD Al-Azhar Kelapa Gading',
                'parent_name' => 'Rahmat Hidayat',
                'parent_phone' => '085712345678',
                'address' => 'Jl. Tebet Timur Dalam VII No. 19, Jakarta Selatan',
                'days_ago' => 2,
            ],
            [
                'full_name' => 'Farhan Arya Daniswara',
                'birth_date' => '2015-05-18',
                'category' => 'sd',
                'school' => 'SD Negeri Menteng 01',
                'parent_name' => 'Agus Daniswara',
                'parent_phone' => '082199881122',
                'address' => 'Jl. Cikini Raya No. 14, Menteng, Jakarta Pusat',
                'days_ago' => 1,
            ],
            [
                'full_name' => 'Clarissa Aurelia Santoso',
                'birth_date' => '2016-09-30',
                'category' => 'sd',
                'school' => 'SD Santa Ursula Jakarta',
                'parent_name' => 'Stefanus Santoso',
                'parent_phone' => '081233445566',
                'address' => 'Jl. Juanda No. 8, Pasar Baru, Jakarta Pusat',
                'days_ago' => 0,
            ],

            // Kategori SMP
            [
                'full_name' => 'Ahmad Fakhri Ramadhan',
                'birth_date' => '2012-07-15',
                'category' => 'smp',
                'school' => 'SMP Labschool Kebayoran',
                'parent_name' => 'Ir. Irwan Kurniawan',
                'parent_phone' => '081122334455',
                'address' => 'Jl. KH Ahmad Dahlan No. 14, Kebayoran Baru, Jakarta Selatan',
                'days_ago' => 6,
            ],
            [
                'full_name' => 'Chelsea Felicia Wijaya',
                'birth_date' => '2013-01-20',
                'category' => 'smp',
                'school' => 'SMP Kanisius Jakarta',
                'parent_name' => 'Michael Wijaya',
                'parent_phone' => '081699001122',
                'address' => 'Jl. Menteng Raya No. 64, Jakarta Pusat',
                'days_ago' => 4,
            ],
            [
                'full_name' => 'Raden Bagus Dimas Saputra',
                'birth_date' => '2011-12-05',
                'category' => 'smp',
                'school' => 'SMP Negeri 115 Jakarta',
                'parent_name' => 'Gunawan Saputra',
                'parent_phone' => '081807654321',
                'address' => 'Jl. Tebet Utara III No. 22, Jakarta Selatan',
                'days_ago' => 3,
            ],
            [
                'full_name' => 'Siti Khadijah Al-Munawwarah',
                'birth_date' => '2012-09-14',
                'category' => 'smp',
                'school' => 'SMP Al-Azhar 9 Bekasi',
                'parent_name' => 'Drs. H. Mulyono',
                'parent_phone' => '085211998877',
                'address' => 'Komp. Kemang Pratama 2 Blok AL No. 5, Bekasi',
                'days_ago' => 1,
            ],
            [
                'full_name' => 'Kevin Alexander Salim',
                'birth_date' => '2013-03-29',
                'category' => 'smp',
                'school' => 'SMP Negeri 1 Jakarta',
                'parent_name' => 'Eddy Salim',
                'parent_phone' => '081744556677',
                'address' => 'Jl. Cempaka Putih Tengah 2 No. 10, Jakarta Pusat',
                'days_ago' => 0,
            ],
        ];

        foreach ($dummyParticipants as $data) {
            $daysAgo = $data['days_ago'];
            unset($data['days_ago']);

            $regTime = Carbon::now()->subDays($daysAgo)->subHours(rand(1, 8))->subMinutes(rand(10, 50));

            Registration::create(
                array_merge($data, [
                    'registered_at' => $regTime,
                    'created_at' => $regTime,
                    'updated_at' => $regTime,
                ])
            );
        }
    }
}
