<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'id' =>1,
            'user_id' => 1,
            'name' => 'Admin',
            'birthday' => '2000-09-20',
            'email' => 'admin@gmail.com',
            'avatar' => 'null.png',
        ]);

        $faker = Faker\Factory::create();

        $limit = 10;

//        for ($i = 2; $i < $limit; $i++) {
//            $data = [
//                'id' => $i,
//                'name' => $faker->name,
//                'birthday' =>$faker->date('Y-m-d','now'),
//                'phone' => $faker->phoneNumber,
//                'email' => $faker->unique()->email,
//                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
//                'gender' => random_int(0,1),
//                'course_id' => 1,
//                'address' => $faker->address,
//                'avg_score' => 0
//
//            ];
//            app(App\Http\Controllers\StudentController::class)->dataFake($data);
//        }
    }
}
