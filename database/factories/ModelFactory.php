<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $name = $faker->name;
    $slug = str_slug($name);

    return [
        'name'           => $name,
        'slug'           => $slug,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Snippet::class, function (Faker\Generator $faker) {
    $name = $faker->text;
    $slug = str_slug($name);

    return [
        'title'   => $name,
        'user_id' => 1,
        'slug'    => $slug,
        'body'    => $faker->paragraph,
    ];
});
