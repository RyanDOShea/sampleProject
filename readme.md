Dependencies From Composer:
 - 
 - consoletvs/charts
 
 A few notes:
 -
 - This is running Laravel 5.2, so it uses the old directory structure.
 - The biggest change is models sit in the app folder, and the routes file sits in the Http folder
 
 To get up and running from scratch
  - 
  - pull depot
  - run composer install
  - set up database connection
  - run migration and seeder
  - register your own user, and take the one exercise
  - look at the results!
  - Cheers
  
  
  Important files: 
  -
  - Http/ExerciseController
  - all the models for the relationship toolset
  - resources/views/exercise/exercise.blade.php
  - "" results.blade.php
  
  
  Database Structure:
  -
  Exercise has many questions
  question has many answers
  answers has many responses
  users has many responses