<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User;
        $user->name="Jorge Astudillo";
        $user->email="jastudillo@ssdr.gob.cl";
        $user->password=Hash::make("17218726");
        $user->save();
        $rol=Role::where('name','Dios')->first();
        $user->assignRole($rol->id);

       

    }
}
