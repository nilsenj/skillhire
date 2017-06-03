<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $user = \App\Models\User::UpdateOrCreate([
            'name' => 'nilsenj',

            'email' => 'nilsenj@yandex.ua',

            'password' => 'nilsenj',
        ]);

        $user->attachRole(1);

        $user = \App\Models\User::UpdateOrCreate([
            'name' => 'nilsenj',

            'email' => 'nikoleivan@gmail.com',

            'password' => 'nilsenj-dev-01',
        ]);

        $user->attachRole(2);

        factory(\App\Models\User::class, 20)->create()->each(function ($u) {
            $u->attachRole(2);
        });
    }
}
