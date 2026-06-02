<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        $users = [
            ['name' => 'Unit Pengolah TMB', 'email' => 'uptmb@rri.co.id', 'password' => 'teknik123', 'role' => 'up', 'unit_pengolah_id' => 1],
            ['name' => 'Unit Pengolah Siaran', 'email' => 'upsiaran@rri.co.id', 'password' => 'siaran123', 'role' => 'up', 'unit_pengolah_id' => 2],
            ['name' => 'Unit Pengolah KMB', 'email' => 'upkmb@rri.co.id', 'password' => 'kmb123', 'role' => 'up', 'unit_pengolah_id' => 3],
            ['name' => 'Unit Pengolah LPU', 'email' => 'uplpu@rri.co.id', 'password' => 'lpu123', 'role' => 'up', 'unit_pengolah_id' => 4],
            ['name' => 'Unit Pengolah Keuangan', 'email' => 'upkeuangan@rri.co.id', 'password' => 'keuangan123', 'role' => 'up', 'unit_pengolah_id' => 5],
            ['name' => 'Unit Pengolah Umum', 'email' => 'upumum@rri.co.id', 'password' => 'umum123', 'role' => 'up', 'unit_pengolah_id' => 6],
            ['name' => 'Unit Pengolah SDM', 'email' => 'upsdm@rri.co.id', 'password' => 'sdm123', 'role' => 'up', 'unit_pengolah_id' => 7],
            ['name' => 'Unit Pengolah Sekretariat', 'email' => 'upsekretariat@rri.co.id', 'password' => 'sekretariat123', 'role' => 'up', 'unit_pengolah_id' => 8],
            ['name' => 'Unit Pengolah Pemberitaan', 'email' => 'uppemberitaan@rri.co.id', 'password' => 'pemberitaan123', 'role' => 'up', 'unit_pengolah_id' => 9],
            ['name' => 'Operator PPID', 'email' => 'operatorppid@rri.co.id', 'password' => 'ppid123', 'role' => 'ppid', 'unit_pengolah_id' => null],
            ['name' => 'Manajemen', 'email' => 'manajemen@rri.co.id', 'password' => 'manajemen123', 'role' => 'manajemen', 'unit_pengolah_id' => null],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                    'unit_pengolah_id' => $user['unit_pengolah_id']
                ]
            );
        }
    }
}
