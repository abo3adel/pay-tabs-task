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

    public function test_category_has_sub_categories()
    {
        $category = Category::factory()->create(['category_id' => null]);

        $this->assertNotNull($category->sub_categories);

        $category->sub_categories()->create(Category::factory()->raw([
            'category_id' => $category->id,
        ]));

        $category->refresh();

        $this->assertCount(1, $category->sub_categories);
    }

    public function test_category_has_parent()
    {
        $parent = Category::factory()->create(['category_id' => null]);

        $this->assertNull($parent->parent);

        $category = Category::factory()->create(['category_id' => $parent->id]);

        $this->assertEquals($category->parent->name, $parent->name);
    }
}
