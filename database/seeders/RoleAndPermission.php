<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create([
            'name' => 'super-admin',
            'description' => 'pengguna akan memiliki semua hak akses super admin'
        ]);

        $admin = Role::create([
            'name' => 'admin',
            'description' => 'pengguna akan memiliki semua hak akses admin'
        ]);

        //crud about role
        $pengguna = Role::create([
            'name' => 'pengguna',
            'description' => 'pengguna akan memiliki hak akses biasa'
        ]);

        // crud about umkm
        $addumkm = Permission::create([
            'name' => 'create-umkm',
            'description' => 'pengguna dapat menambahkan umkm'
        ]);
        $showumkm = Permission::create([
            'name' => 'full-umkm',
            'description' => 'pengguna dapat menambahkan melihat full view umkm'
        ]);
        $exportumkm = Permission::create([
            'name' => 'export-umkm',
            'description' => 'pengguna dapat menngexport data'
        ]);
        $editumkm = Permission::create([
            'name' => 'edit-umkm',
            'description' => 'pengguna dapat mengedit umkm'
        ]);

        $deleteumkm = Permission::create([
            'name' => 'delete-umkm',
            'description' => 'pengguna dapat mengedit umkm'
        ]);

        // crud about category
        $showcategory = Permission::create([
            'name' => 'show-category',
            'description' => 'pengguna dapat melihat category'
        ]);
        $addcategory = Permission::create([
            'name' => 'add-category',
            'description' => 'pengguna dapat menambahkan category baru'
        ]);
        $editcategory = Permission::create([
            'name' => 'edit-category',
            'description' => 'pengguna dapat mengedit category  yang telah ada'
        ]);
        $deletecategory = Permission::create([
            'name' => 'delete-category',
            'description' => 'pengguna dapat menghapus category yang telah ada'
        ]);

        // crud about division
        $showdesa = Permission::create([
            'name' => 'show-desa',
            'description' => 'pengguna dapat menampilkan desa'
        ]);
        $showkecamatan = Permission::create([
            'name' => 'show-kecamatan',
            'description' => 'pengguna dapat menampilkan kecamatan'
        ]);
        $showbidang = Permission::create([
            'name' => 'show-bidang',
            'description' => 'pengguna dapat menampilkan bidang'
        ]);

        $showpelatihan = Permission::create([
            'name' => 'show-pelatihan',
            'description' => 'pengguna dapat menampilkan pelatihan'
        ]);
        $show_category_pelatihan = Permission::create([
            'name' => 'show-category-pelatihan',
            'description' => 'pengguna dapat menampilkan kategori pelatihan'
        ]);

        // $showpeserta = Permission::create([
        //     'name' => 'show-peserta',
        //     'description' => 'pengguna dapat menampilkan peserta pelatihan'
        // ]);

      
        
        $showbantuan = Permission::create([
            'name' => 'show-bantuan',
            'description' => 'pengguna dapat menampilkan bantuan'
        ]);
        $show_penerima_bantuan = Permission::create([
            'name' => 'show-penerima-bantuan',
            'description' => 'pengguna dapat penerima bantuana'
        ]);
        
        $showperizinan = Permission::create([
            'name' => 'show-perizinan',
            'description' => 'pengguna dapat menampilkan perizinan'
        ]);

        
        $show_penerima_izin = Permission::create([
            'name' => 'show-penerima_izin',
            'description' => 'pengguna dapat menampilkan bidang'
        ]);
        
        // crud about role
        $showrole = Permission::create([
            'name' => 'show-role',
            'description' => 'pengguna dapat menampilkan menu manajemen role'
        ]);
        $addrole = Permission::create([
            'name' => 'add-role',
            'description' => 'pengguna dapat menambahkan role baru'
        ]);
        $editrole = Permission::create([
            'name' => 'edit-role',
            'description' => 'pengguna dapat mengedit role  yang telah ada'
        ]);
        $deleterole = Permission::create([
            'name' => 'delete-role',
            'description' => 'pengguna dapat menghapus role yang telah ada'
        ]);

        //crud about permissions
        $showpermissions = Permission::create([
            'name' => 'show-permission',
            'description' => 'pengguna dapat menampilkan menu manajemen hak akses'
        ]);
        $addpermission = Permission::create([
            'name' => 'add-permission',
            'description' => 'pengguna dapat menambahkan hak akses baru'
        ]);
        $editpermission = Permission::create([
            'name' => 'edit-permission',
            'description' => 'pengguna dapat mengedit hak akses yang telah ada'
        ]);
        $deletepermission = Permission::create([
            'name' => 'delete-permission',
            'description' => 'pengguna dapat menghapus hak akses  yang telah ada'
        ]);

    }
}