<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NekiNoviTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_check_if_something_true_idfk(): void
    {
        // check if /categories route is working
        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertViewIs('category.index');
    }
}
