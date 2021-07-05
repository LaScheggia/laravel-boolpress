<?php
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['HTML','CSS','JavaScript','PHP'];
        foreach ($data as $value) {
            $new_cat = new Category();
            $new_cat->name = $value;
            $new_cat->slug = Str::slug($value,'-');
            $new_cat->save();
        }
    }
}
