<?php

use Illuminate\Database\Seeder;

class StoryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storytypes')->truncate();
        DB::table('storytypes')->insert([
            [
                'name' => 'Basic Story',
                'shortname' => 'storybasic'
            ],
            [
                'name' => 'Promoted Story',
                'shortname' => 'storypromoted'
            ],
            [
                'name' => 'Student Profile',
                'shortname' => 'storystudent'
            ],
            [
                'name' => 'Magazine Story',
                'shortname' => 'storymagazine'
            ],

        ]);
    }
}
