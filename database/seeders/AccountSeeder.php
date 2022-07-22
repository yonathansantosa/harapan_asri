<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (Schema::hasTable('accounts')) {
            DB::table('accounts')->truncate();
        }

        // Admin
        DB::table('accounts')->insert([
            'username' => 'admin',
            'id_level' => 1,
            'password' => Hash::make('admin123'),
        ]);

        // Manajer
        DB::table('accounts')->insert([
            'username' => 'manajer',
            'id_level' => 2,
            'password' => Hash::make('manajer123'),
        ]);

        // Perawat
        DB::table('accounts')->insert([
            'username' => 'perawat',
            'id_level' => 3,
            'password' => Hash::make('perawat123'),
        ]);

        // Assisten Perawat
        DB::table('accounts')->insert([
            'username' => 'assistenperawat',
            'id_level' => 4,
            'password' => Hash::make('assistenperawat123'),
        ]);

        // Fisioterapi
        DB::table('accounts')->insert([
            'username' => 'fisioterapi',
            'id_level' => 5,
            'password' => Hash::make('fisioterapi123'),
        ]);

        // Farmasi
        DB::table('accounts')->insert([
            'username' => 'farmasi',
            'id_level' => 6,
            'password' => Hash::make('farmasi123'),
        ]);
    }
}
