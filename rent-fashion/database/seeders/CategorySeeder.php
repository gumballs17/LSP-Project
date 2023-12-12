<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Categories::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Traditional', 'Wedding', 'Formal', 'Costume'
        ];

        foreach ($data as $value) {
            Categories::insert([
                'name' => $value,
            ]);

        }
    }
}
