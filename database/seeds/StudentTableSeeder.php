<?php

use Illuminate\Database\seeder;
use App\Student;
use App\User;

class StudentTableSeeder extends Seeder {

    public function run()
    {
        Student::truncate();

        $faker = \Faker\Factory::create();

        foreach(range(1, 10) as $range) {
            $student = Student::create(array(
                'name' => $faker->name,
                'gender'=> 'male',
                'parent_id'=> ($range>3 ? 1: $range ),
                'student_reg' => 'ST'.rand(100000, 999999),
                'class_id' => $faker->numberBetween(1, 11),
                'class_type_id' => $faker->numberBetween(1, 5),
                'dob' => $faker->date(),
                'phone' => $faker->phoneNumber,
            ));

            User::create(array(
                'username'=> $student->student_reg,
                'userable_id'=>$student->id,
                'password' => bcrypt('123456'),
                'userable_type'=>"App\\Student"
            ));
        }
    }
}
