<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空数据表
        \App\Article::truncate();

        //添加数据
        factory(\App\Article::class,50)->create();
    }
}
