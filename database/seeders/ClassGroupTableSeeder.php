<?php
namespace Database\Seeders;
use Illuminate\Database\seeder;
use App\ClassGroup;

class ClassGroupTableSeeder extends Seeder {

    public function run()
    {
        ClassGroup::truncate();

        $groups = ['LOWER', 'JUNIOR', 'SENIOR'];

        foreach($groups as $key => $group) {
            ClassGroup::create(array(
                'name' => $group,
            ));
        }
    }
}
