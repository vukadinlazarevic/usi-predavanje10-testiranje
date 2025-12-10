<?php

namespace Tests\Unit;

use App\Http\Controllers\AdvertisementController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use Tests\TestCase;

class AdvertisementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view(): void
    {
        $controller = new AdvertisementController();
        $request = new Request();

        $result = $controller->index($request);

        $this->assertInstanceOf(View::class, $result);
        $this->assertEquals('advertisement.index', $result->name());
    }
}

