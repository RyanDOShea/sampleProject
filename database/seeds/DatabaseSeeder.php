<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('exercises')->insert([
            ['title' => 'Mood and Day Questions'],
        ]);

        DB::table('users')->insert([
            //making a simple user so I can hang all the seeded data off of it.
            ['name' => 'ryan', 'email' => 'ryandennisoshea@gmail.com' , 'password' => 'potato'],
        ]);

        DB::table('questions')->insert([
            ['exercise_id' => 1,'body' => 'What kind of mood are you in?'],
            ['exercise_id' => 1,'body' => 'How would you say your day has been?'],
            ['exercise_id' => 1,'body' => 'How do you expect your day to go?'],
        ]);

        DB::table('answers')->insert([
            ['question_id' => 1,'body' => 'Happy'],
            ['question_id' => 1,'body' => 'Upset'],
            ['question_id' => 1,'body' => 'Sad'],
            ['question_id' => 1,'body' => 'Unsure'],
            ['question_id' => 1,'body' => 'Not Strongly in any direction'],

            ['question_id' => 2,'body' => 'Good'],
            ['question_id' => 2,'body' => 'Ok'],
            ['question_id' => 2,'body' => 'Bad'],
            ['question_id' => 2,'body' => 'Boring'],
            ['question_id' => 2,'body' => 'Forgetable'],

            ['question_id' => 3,'body' => 'Good'],
            ['question_id' => 3,'body' => 'Bad'],
            ['question_id' => 3,'body' => 'I do not know'],
            ['question_id' => 3,'body' => 'Boring'],
            ['question_id' => 3,'body' => 'Exciting'],

        ]);

        DB::table('responses')->insert([
            ['user_id' => 1,'answer_id' => 1],
            ['user_id' => 1,'answer_id' => 7],
            ['user_id' => 1,'answer_id' => 13],

            ['user_id' => 1,'answer_id' => 4],
            ['user_id' => 1,'answer_id' => 6],
            ['user_id' => 1,'answer_id' => 11],

            ['user_id' => 1,'answer_id' => 1],
            ['user_id' => 1,'answer_id' => 8],
            ['user_id' => 1,'answer_id' => 11],

            ['user_id' => 1,'answer_id' => 5],
            ['user_id' => 1,'answer_id' => 10],
            ['user_id' => 1,'answer_id' => 15],

            ['user_id' => 1,'answer_id' => 2],
            ['user_id' => 1,'answer_id' => 9],
            ['user_id' => 1,'answer_id' => 14],

            ['user_id' => 1,'answer_id' => 3],
            ['user_id' => 1,'answer_id' => 8],
            ['user_id' => 1,'answer_id' => 12],

            ['user_id' => 1,'answer_id' => 5],
            ['user_id' => 1,'answer_id' => 10],
            ['user_id' => 1,'answer_id' => 15],

            ['user_id' => 1,'answer_id' => 2],
            ['user_id' => 1,'answer_id' => 9],
            ['user_id' => 1,'answer_id' => 14],

            ['user_id' => 1,'answer_id' => 3],
            ['user_id' => 1,'answer_id' => 8],
            ['user_id' => 1,'answer_id' => 12],


        ]);

    }
}
