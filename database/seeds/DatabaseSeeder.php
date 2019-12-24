<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $this->call([
            StudentClassTableSeeder::class,
            TeacherTableSeeder::class,
            StudentTableSeeder::class,
            AdminTableSeeder::class,
            GuardianTableSeeder::class,
            CategoryTableSeeder::class,
            ThreadTableSeeder::class,
            TermTableSeeder::class,
            schoolTableSeeder::class,
            SubjectTableSeeder::class,
            PostTableSeeder::class,
            NewsBoardTableSeeder::class,
            ClassGroupTableSeeder::class,
        ]);
        

    }
}
