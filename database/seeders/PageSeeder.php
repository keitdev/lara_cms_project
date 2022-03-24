<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);

        $admin->pages()->saveMany([
            new Page([
                'title' => 'About',
                'url' => '/about',
                'content' => 'This is about page'
            ]),
            new Page([
                'title' => 'Contact',
                'url' => '/contact',
                'content' => 'This is contact page'
            ]),
            new Page([
                'title' => 'Another Page',
                'url' => '/another-page',
                'content' => 'This is another page'
            ]),
        ]);
    }
}
