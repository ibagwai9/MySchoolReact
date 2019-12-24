<?php

use Illuminate\Database\seeder;
use App\school;

class schoolTableSeeder extends Seeder {

    public function run()
    {
        school::truncate();

        $groups = ['APEX', 'BLISS', 'GOLD', 'SILVER', 'BRONZE', 'DIAMOND'];

        foreach($groups as $key => $group) {
            school::create(array(
                'name' => $group,
            ));
        }
    }
}
