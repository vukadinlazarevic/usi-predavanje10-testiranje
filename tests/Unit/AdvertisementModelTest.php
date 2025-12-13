<?php

namespace Tests\Unit;

use App\Models\Advertisement;
use PHPUnit\Framework\TestCase;

class AdvertisementModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_oglas_ima_relaciju_category()
    {
        $advertisement = new Advertisement();
        $this->assertTrue(
            method_exists($advertisement, 'category'),
            "Advertisement nema definisanu category relaciju"
        );
    }
}
