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
        $user = App\User::create([
        	'name' 		=>	'Jason Bato Delarosa',
        	'email' 	=>	'alvinespejo@hotmail.com',
        	'password'	=>	bcrypt(123456),
            'admin'     =>  1
        ]);

        $profile = App\Profile::create([
            'user_id'   => $user->id,
            'about'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque velit autem ullam expedita ut, repellendus magnam tempora amet saepe, ea excepturi, quaerat dolores id voluptas pariatur voluptatum labore quod tempore?',
            'avatar'    => 'uploads/avatars/default.png',
            'facebook'  => 'www.facebook.com',
            'youtube'   => 'www.youtube.com',
            'google'    => 'www.google.com',
            'twitter'   => 'www.twitter.com'
        ]);
    }
}


