<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'title' => 'Sách 01',
                'slug' => Str::slug('Sách 01'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 02',
                'slug' => Str::slug('Sách 02'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 03',
                'slug' => Str::slug('Sách 03'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 04',
                'slug' => Str::slug('Sách 04'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 05',
                'slug' => Str::slug('Sách 05'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 06',
                'slug' => Str::slug('Sách 06'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 07',
                'slug' => Str::slug('Sách 07'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 08',
                'slug' => Str::slug('Sách 08'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 09',
                'slug' => Str::slug('Sách 09'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 10',
                'slug' => Str::slug('Sách 10'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 11',
                'slug' => Str::slug('Sách 11'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 12',
                'slug' => Str::slug('Sách 12'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 13',
                'slug' => Str::slug('Sách 13'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 14',
                'slug' => Str::slug('Sách 14'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Sách 15',
                'slug' => Str::slug('Sách 15'),
                'price' => 10000,
                'quantity' => rand(40, 100),
                'images' => '/storage/photos/1/book.png',
                'page_number' => rand(100, 400),
                'description' => Str::random(200),
                'discount' => rand(1, 15),
                'status' => 'active',
                'publication_date' => Carbon::now(),
                'reprint_date' => Carbon::now(),
                'category_id' => $this->getRandomCategoryId(),
                'language_id' => $this->getRandomLanguageId(),
                'author_id' => $this->getRandomAuthorId(),
                'publisher_id' => $this->getRandomPublisherId(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }

    private function getRandomCategoryId()
    {
        $parentIds = DB::table('categories')->whereNull('parent_id')->pluck('id')->toArray();
        return Arr::random($parentIds, 1)[0];
    }

    private function getRandomLanguageId()
    {
        $parentIds = DB::table('languages')->pluck('id')->toArray();
        return Arr::random($parentIds, 1)[0];
    }

    private function getRandomAuthorId()
    {
        $parentIds = DB::table('authors')->pluck('id')->toArray();
        return Arr::random($parentIds, 1)[0];
    }

    private function getRandomPublisherId()
    {
        $parentIds = DB::table('publishers')->pluck('id')->toArray();
        return Arr::random($parentIds, 1)[0];
    }
}
