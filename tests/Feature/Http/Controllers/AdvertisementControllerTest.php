<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AdvertisementController
 */
final class AdvertisementControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $advertisements = Advertisement::factory()->count(3)->create();

        $response = $this->get(route('advertisements.index'));

        $response->assertOk();
        $response->assertViewIs('advertisement.index');
        $response->assertViewHas('advertisements', $advertisements);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('advertisements.create'));

        $response->assertOk();
        $response->assertViewIs('advertisement.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AdvertisementController::class,
            'store',
            \App\Http\Requests\AdvertisementStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);
        $price = fake()->numberBetween(-10000, 10000);
        $start_date = Carbon::parse(fake()->date());
        $end_date = Carbon::parse(fake()->date());
        $category = Category::factory()->create();

        $response = $this->post(route('advertisements.store'), [
            'title' => $title,
            'content' => $content,
            'price' => $price,
            'start_date' => $start_date->toDateString(),
            'end_date' => $end_date->toDateString(),
            'category_id' => $category->id,
        ]);

        $advertisements = Advertisement::query()
            ->where('title', $title)
            ->where('content', $content)
            ->where('price', $price)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $advertisements);
        $advertisement = $advertisements->first();

        $response->assertRedirect(route('advertisements.index'));
        $response->assertSessionHas('advertisement.id', $advertisement->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $advertisement = Advertisement::factory()->create();

        $response = $this->get(route('advertisements.show', $advertisement));

        $response->assertOk();
        $response->assertViewIs('advertisement.show');
        $response->assertViewHas('advertisement', $advertisement);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $advertisement = Advertisement::factory()->create();

        $response = $this->get(route('advertisements.edit', $advertisement));

        $response->assertOk();
        $response->assertViewIs('advertisement.edit');
        $response->assertViewHas('advertisement', $advertisement);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AdvertisementController::class,
            'update',
            \App\Http\Requests\AdvertisementUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $advertisement = Advertisement::factory()->create();
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);
        $price = fake()->numberBetween(-10000, 10000);
        $start_date = Carbon::parse(fake()->date());
        $end_date = Carbon::parse(fake()->date());
        $category = Category::factory()->create();

        $response = $this->put(route('advertisements.update', $advertisement), [
            'title' => $title,
            'content' => $content,
            'price' => $price,
            'start_date' => $start_date->toDateString(),
            'end_date' => $end_date->toDateString(),
            'category_id' => $category->id,
        ]);

        $advertisement->refresh();

        $response->assertRedirect(route('advertisements.index'));
        $response->assertSessionHas('advertisement.id', $advertisement->id);

        $this->assertEquals($title, $advertisement->title);
        $this->assertEquals($content, $advertisement->content);
        $this->assertEquals($price, $advertisement->price);
        $this->assertEquals($start_date, $advertisement->start_date);
        $this->assertEquals($end_date, $advertisement->end_date);
        $this->assertEquals($category->id, $advertisement->category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $advertisement = Advertisement::factory()->create();

        $response = $this->delete(route('advertisements.destroy', $advertisement));

        $response->assertRedirect(route('advertisements.index'));

        $this->assertModelMissing($advertisement);
    }
}
