<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $parentCategories = Category::factory(3)->sequence(
            ['name' => 'Category A'],
            ['name' => 'Category B'],
            ['name' => 'Category C']
        )->create([
            'category_id' => null,
        ]);

        $this->createSubCategories($parentCategories, 9);

        $this->createSubCategories(Category::whereLevel(2)->get(), 4, 3);

        $this->createSubCategories(Category::whereLevel(3)->get(), 8, 4);
    }

    private function createSubCategories(Collection $parentCategories, int $subInx, int $level = 2): void
    {
        foreach ($parentCategories as $parent) {
            $split = $level > 2 ? '-' : '';
            Category::factory(3)->sequence(
                ['name' => str_repeat('Sub ', $level - 1) . substr($parent->name, $subInx) . $split . 1],
                ['name' => str_repeat('Sub ', $level - 1) . substr($parent->name, $subInx) . $split . 2],
                ['name' => str_repeat('Sub ', $level - 1) . substr($parent->name, $subInx) . $split . 3],
            )->create([
                'category_id' => $parent->id,
                'level' => $level
            ]);
        }
    }
}
