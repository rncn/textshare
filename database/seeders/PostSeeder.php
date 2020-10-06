<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => Str::random(10),
            'content' => "<h1>".Str::random(10)."</h1>".Str::random(900000)."<a href='https://www.".Str::random(10).".com'>".Str::random(120)."</a>",
            'theme_id' => '1',
            'password' => Hash::make(Str::random(18)),
            'delpassword' => Hash::make(Str::random(18)),
        ]);
    }
}
