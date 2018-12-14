<?php

use Illuminate\Database\Seeder;

class lectureCate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        DB::table('LectureCat')->insert(['id'=> 1, 'title'=> '職涯講座']);
        DB::table('LectureCat')->insert(['id'=> 2, 'title'=> '就業博覽會']);
        DB::table('lectures')->update(['type' => 1]);
    }
}
