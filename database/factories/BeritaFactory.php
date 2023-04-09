<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = Str::title(fake()->sentence(8));

        return [
            'JUDUL' => $judul,
            'ISI' => fake()->paragraph(5),
            'IDKATEGORI' => Kategori::inRandomOrder()->first(), 
        ];
    }
}
