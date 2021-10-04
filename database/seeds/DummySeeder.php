<?php

use Illuminate\Database\Seeder;
use App\Model\Common\Category;
use App\Model\Common\Author;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $now = Carbon::now()->toDateTimeString();

        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        Category::insert([
            ['title' => 'আইন ও বিচার', 'slug' => str_slug('cat-1'), 'parent_id' => 0, 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'ভ্রমণ ও প্রবাস', 'slug' => str_slug('cat-2'), 'parent_id' => 0, 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'মুক্তিযুদ্ধ', 'slug' => str_slug('cat-3'), 'parent_id' => 0, 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
        Author::insert([
            ['title' => 'হুমায়ূন আহমেদ', 'slug' => str_slug('aut-1'), 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'আরিফ আজাদ', 'slug' => str_slug('aut-2'), 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'সমরেশ মজুমদার', 'slug' => str_slug('aut-3'), 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
        \App\Model\Common\Publisher::insert([
            ['title' => 'সেবা প্রকাশনী', 'slug' => str_slug('pub-1'), 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'প্রথমা প্রকাশন', 'slug' => str_slug('pub-2'), 'is_featured' => 1, 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
        \App\Model\Common\Payment_method::insert([
            ['title' => 'Cash On Delivery', 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Online Payment', 'created_by' => 1, 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::statement("SET FOREIGN_KEY_CHECKS = 1");

        DB::commit();
    }
}
