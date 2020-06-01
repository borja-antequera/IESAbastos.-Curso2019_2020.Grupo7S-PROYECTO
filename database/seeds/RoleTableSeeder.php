<?php

use Illuminate\Database\Seeder;
use agendaInfantil\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->rol_nombre = "superadmin";
        $role->rol_descripcion = "Super administrador";
        $role->save();

        $role = new Role();
        $role->rol_nombre = "admin";
        $role->rol_descripcion = "Administrador";
        $role->save();

        $role = new Role();
        $role->rol_nombre = "user";
        $role->rol_descripcion = "Usuario";
        $role->save();
    }
}
