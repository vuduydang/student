<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            $data = [
                'name' => $faker->name,
                'birthday' =>$faker->date('Y-m-d','now'),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
                'gender' => random_int(0,1),
                'course_id' => 1,
                'address' => $faker->address,
                'avg_score' => 0

            ];
            app(App\Http\Controllers\StudentController::class)->dataFake($data);
        }
    }
}
