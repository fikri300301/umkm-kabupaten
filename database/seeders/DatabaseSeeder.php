<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ConfigSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ConfigSeeder::class);
        $this->call(RoleAndPermission::class);
        $this->call(PerizinanSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(DesaSeeder::class);
        $this->call(BidangSeeder::class);
        $this->call(BantuanSeeder::class);
        $this->call(CategoryPelatihanSeeder::class);
        $this->call(PelatihanSeeder::class);
        $this->call(CategorySeeder::class);
        $user = User::create([
            'name' => 'yusuf',
            'email' => 'yusuf99@gmail.com',
            // 'phone' => '08938294823',
            'password' => bcrypt('superadmin'),
        ]);
        $user->assignRole('super-admin');

        $user1 = User::create([
            'name' => 'produksi',
            'email' => 'bidangproduksi@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('bidangproduksi'),
        ]);
        $user1->assignRole('pengguna');

        
        $user2 = User::create([
            'name' => 'pembiayaan',
            'email' => 'bidangpembiayaan@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('bidangpembiayaan'),
        ]);
        $user2->assignRole('pengguna');
        
        $user3 = User::create([
            'name' => 'kelembagaan',
            'email' => 'bidangkelembagaan@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('bidangkelembagaan'),
        ]);
        $user3->assignRole('pengguna');

        
        $user4 = User::create([
            'name' => 'sekretariat',
            'email' => 'sekretariat@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('bidangsekretariat'),
        ]);
        $user4->assignRole('pengguna');

        $user4 = User::create([
            'name' => 'Kepala Dinas',
            'email' => 'kadiskopusmik@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('kadis123'),
        ]);
        $user4->assignRole('pengguna');

        $user5 = User::create([
            'name' => 'Penguna 1',
            'email' => 'pengguna1@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('penggunasatu123'),
        ]);
        $user5->assignRole('pengguna');

        $user6 = User::create([
            'name' => 'Penguna 2',
            'email' => 'pengguna2@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('penggunadua123'),
        ]);
        $user6->assignRole('pengguna');

        $user7 = User::create([
            'name' => 'Penguna 3',
            'email' => 'pengguna3@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('penggunatiga123'),
        ]);
        $user7->assignRole('pengguna');

        $user8 = User::create([
            'name' => 'Penguna 4',
            'email' => 'pengguna4@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('penggunaempat123'),
        ]);
        $user8->assignRole('pengguna');

        $user9 = User::create([
            'name' => 'Penguna 5',
            'email' => 'pengguna5@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('penggunalima123'),
        ]);
        $user9->assignRole('pengguna');

        $user10 = User::create([
            'name' => 'Penguna 6',
            'email' => 'pengguna6@gmail.com',
            // 'phone' => '089382948231',
            'password' => bcrypt('penggunaenam123'),
        ]);
        $user10->assignRole('pengguna');
    }
}