<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Advertisement;
use Carbon\Carbon;

class AdvertisementRoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_statusni_kod_200_advertisements(): void
    {
        $response = $this->get("/advertisements");

        $response->assertStatus(200);

        $response->assertViewIs("advertisement.index");
    }

    public function test_kreiranje_novog_oglasa() {
        $category = Category::factory()->create();

        $payload = [
            'title' => "Test Oglas",
            "content" => "Sadrzaj oglasa",
            "price" => 100,
            "start_date" => Carbon::now()->format("Y-m-d"),
            "end_date" => Carbon::now()->addDays(5)->format("Y-m-d"),
            "category_id" => $category->id,
        ];

        $response = $this->post("/advertisements", $payload);

        // laravel obicno nakon unosa podataka, preusmeri korisnika na neku drugu rutu
        /// 300 
        $response->assertStatus(302);

        $this->assertDatabaseHas('advertisements', [
            "title" => "Test Oglas",
            "category_id" => $category->id,
        ]);
    }

    public function test_blejd_za_pojedinacne_oglase() {
        $ad = Advertisement::factory()->create();

        $response = $this->get("/advertisements/{$ad->id}");

        $response->assertStatus(200);
        $response->assertViewIs('advertisement.show');
        $response->assertSee($ad->title);
    }
}
