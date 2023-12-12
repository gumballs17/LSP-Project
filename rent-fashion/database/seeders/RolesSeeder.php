<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Roles::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'admin', 'client'
        ];

        foreach ($data as $value) {
            Roles::insert([
                'name' => $value,
            ]);

        }
    }
}