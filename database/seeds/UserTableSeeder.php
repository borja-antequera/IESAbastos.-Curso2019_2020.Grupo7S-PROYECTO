<?php

use Illuminate\Database\Seeder;
use agendaInfantil\Role;
use agendaInfantil\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_superadmin = Role::where('rol_nombre','superadmin')->first();
        $role_admin = Role::where('rol_nombre','admin')->first();
        $role_user = Role::where('rol_nombre','user')->first();

        $user = new User();
        $user->name = "Superadmin";
        $user->email = "superadmin@mail.com";
        $user->password = bcrypt('superadmin@mail.com');
        $user->rol_id = 1;
        $user->birth_date = "1991-04-10";
        $user->username1 = "Perez";
        $user->username2 = "Fernandez";
        $user->user_slug = "superadmin";
        $user->save();

        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@mail.com";
        $user->password = bcrypt('admin@mail.com');
        $user->rol_id = 2;
        $user->birth_date = "1998-05-10";
        $user->username1 = "Perez";
        $user->username2 = "Fernandez";
        $user->user_slug = "admin";
        $user->save();

        $user = new User();
        $user->name = "User";
        $user->email = "user@mail.com";
        $user->password = bcrypt('user@mail.com');
        $user->rol_id = 3;
        $user->birth_date = "1982-08-07";
        $user->username1 = "Perez";
        $user->username2 = "Fernandez";
        $user->user_slug = "user";
        $user->save();
    }
}
