<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_category_has_slug()
    {
        $category = Category::factory()->create([
            'category_id' => null,
            'name' => $name = fake()->sentence,
        ]);

        $this->assertNotNull($category->slug);

        $this->assertEquals(str($name)->slug(), $category->slug);
    }
}
