<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(100)->create();

        $count = Book::count();

        if($count == 0){
            Cache::forget("books-page-1");
        }
        
        for($i = 1; $i <= $count; $i++){
            $key = 'books-page-' . $i;
            if(Cache::has($key)){
                Cache::forget($key);
            } else {
                break;
            }
        }
    }
}
