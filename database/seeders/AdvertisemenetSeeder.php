<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertisemenetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = Category::all();

        if ($categories->count() === 0) {
            $this->command->warn('No categories found! Run CategorySeeder first.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {

            $startDate = Carbon::now()->subDays(rand(1, 30));
            $endDate = $startDate->copy()->addDays(rand(5, 30));

            Advertisement::create([
                'title'       => fake()->sentence(3),
                'content'     => fake()->paragraph(3),
                'price'       => fake()->numberBetween(100, 10000),
                'start_date'  => $startDate,
                'end_date'    => $endDate,
                'category_id' => $categories->random()->id
            ]);
        }
    }
}
