<?php
namespace Database\Seeders;
use Illuminate\Database\seeder;
use App\Student;
use App\User;

class StudentTableSeeder extends Seeder {

    public function run()
    {
        // Student::truncate();

        $faker = \Faker\Factory::create();

        foreach(range(1, 100) as $range) {
            $student = Student::create(array(
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'other_name' => $faker->name,
                'gender'=> ($range>3 ? 'Male': 'Female' ),
                'parent_id'=> $faker->numberBetween(1,10 ),
                'student_reg' => 'ST'.rand(100000, 999999),
                'class_id' => $faker->numberBetween(1, 11),
                'class_type_id' => $faker->numberBetween(1, 5),
                'dob' => $faker->date(),
                'phone' => $faker->phoneNumber,
            ));

            User::create(array(
                'username'=> $student->student_reg,
                'userable_id'=>$student->id,
                'password' => '123456',
                'userable_type'=>"App\\Student"
            ));
        }
    }
}
