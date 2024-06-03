<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // page profile bem
        Config::create([
            'key' => 'misi',
            'value' => 'foya',
        ]);
        Config::create([
            'key' => 'visi',
            'value' => 'foya',
        ]);
        Config::create([
            'key' => 'banner',
            'value' => 'foya',
        ]);
        Config::create([
            'key' => 'image-filosofi-logo',
            'value' => 'LogoKabinetProfile.png',
        ]);
        Config::create([
            'key' => 'description-filosofi-logo',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam',
        ]);

        // main page
        Config::create([
            'key' => 'slogan',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit',
        ]);
        Config::create([
            'key' => 'home-logo',
            'value' => '/logo/KABINET_LARGE.png',
        ]);
        Config::create([
            'key' => 'footer-logo',
            'value' => '/logo/Logo_footer.png',
        ]);
        Config::create([
            'key' => 'nav-logo',
            'value' => '/logo/KABINET.png',
        ]);
        Config::create([
            'key' => 'narahubung-humas',
            'value' => '0908098012',
        ]);
        Config::create([
            'key' => 'narahubung-sponsor',
            'value' => '0908098012',
        ]);
    }
}
