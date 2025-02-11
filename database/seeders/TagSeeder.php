<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'hardware' => "#00796B", // Teal 700
            'desarrollo' => "#757575", // Grey 600
            "laravel" => "#D32F2F", // Red 500
            'ia' => "#212121", // Grey 900
            'big data' => "#0288D1" // Blue 500
        ];
        foreach($tags as $nombre=>$color){
            Tag::create(compact('nombre', 'color'));
        }
    }
}
