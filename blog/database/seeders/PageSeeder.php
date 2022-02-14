<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages =['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'image'=>'https://assets.entrepreneur.com/content/3x2/2000/20160602195129-businessman-writing-planning-working-strategy-office-focus-formal-workplace-message.jpeg?crop=16:9',
                'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Architecto dignissimos ducimus eius laborum minus modi molestiae nemo nobis officia possimus,
                quas quidem quis ratione rerum, sapiente tempora temporibus tenetur voluptatem!',
                'order'=>$count,
                'slug'=>str_slug($page),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
