<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dios=Role::create(['name' => 'Dios']);
        $admin=Role::create(['name' => 'Admin']);
        $user=Role::create(['name' => 'User']);

        Permission::create(['name' => 'clase.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'clase.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'clase.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'clase.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'clase.destroy'])->syncRoles([$dios,$admin]);
       
        Permission::create(['name' => 'convenio.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'convenio.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'convenio.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'convenio.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'convenio.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'equipo.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'equipo.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'equipo.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'equipo.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'equipo.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'equipoconvenio.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'equipoconvenio.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'equipoconvenio.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'equipoconvenio.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'equipoconvenio.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'familia.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'familia.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'familia.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'familia.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'familia.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'marca.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'marca.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'marca.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'marca.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'marca.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'modelo.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'modelo.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'modelo.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'modelo.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'modelo.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'pago.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'pago.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'pago.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'pago.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'pago.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'proveedor.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'proveedor.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'proveedor.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'proveedor.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'proveedor.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'servicioclinico.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'servicioclinico.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'servicioclinico.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'servicioclinico.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'servicioclinico.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'subclase.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'subclase.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'subclase.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'subclase.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'subclase.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'subfamilia.index'])->syncRoles([$dios,$admin,$user]);
        Permission::create(['name' => 'subfamilia.create'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'subfamilia.edit'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'subfamilia.show'])->syncRoles([$dios,$admin]);
        Permission::create(['name' => 'subfamilia.destroy'])->syncRoles([$dios,$admin]);

        Permission::create(['name' => 'user.index'])->syncRoles([$dios]);
        Permission::create(['name' => 'user.create'])->syncRoles([$dios]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$dios]);
        Permission::create(['name' => 'user.show'])->syncRoles([$dios]);
        Permission::create(['name' => 'user.destroy'])->syncRoles([$dios]);




        
    }
}
