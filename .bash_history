php artisan make:migration create_questions_table
php artisan make:migration create_questions_table
php artisan make:migration create_questions_table
php artisan make:migration create_answers_table
php artisan make:migration create_responses_table --create=responses

php artisan make:model Question
php artisan make:model Answer
php artisan make:model Response
php artisan migrate
sudo chown -R ableto:ableto ../ableToQuiz/
exit
chmod -R 777 storage/
ls -l 
ls -l storage/framework/views/
exit
history | grep create
php artisan make:migration create_execises_table --create=execises
php artisan make:migration create_exercises_table --create=exercises
php artisan migrate
php artisan make:model Exercise
exit
