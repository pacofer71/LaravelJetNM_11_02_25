<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            'Presencial' => "#388E3C", // Green 700
            'Semipresencial' => "#7B1FA2", // Purple 600
            'Bootcamp' => "#D32F2F", // Red 500
            'Distancia' => "#BDBDBD", // Grey 400
            'Híbrido' => "#0288D1" // Blue 500
        ];
        foreach($tipos as $nombre=>$color){
            Type::create(compact('nombre', 'color'));
        }
    }
}
