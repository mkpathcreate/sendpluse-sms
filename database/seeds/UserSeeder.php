<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function($user){
            $categories = \App\Category::where('is_tree', 0)->get()->random(rand(1,10));
            $insert = [];
            foreach ($categories as $category){
                $insert[] = ['user_id' => $user->id, 'category_id' => $category->id];
            }
            $user->category_ranges()->insert($insert);
        });
    }
}
