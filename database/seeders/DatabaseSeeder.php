<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Experience;
use App\Models\Property;
use App\Models\Resource;
use App\Models\Service;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Category::factory(6)->create();
        Experience::factory(10)->create();
        Type::factory(8)->create();
        Service::factory(5)->create();
        Resource::factory(5)->create();
        //Property::factory(3)->create();

        //$superadmin = User::factory()->create([
        //    'name' => 'Yaneth Ramirez',
        //    'email' => 'yanethi.ramirez@gmail.com',
        //]);

        //$admin = User::factory()->create([
        //    'name' => 'Alonso Ramirez',
        //    'email' => 'alonso.ramirez@gmail.com',
        //]);

        //$client = User::factory()->create([
        //    'name' => 'Patricia Ramirez',
        //    'email' => 'patricia.ramirez@gmail.com',
        //]);

        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $permissions = [
            'create',
            'read',
            'update',
            'delete'
        ];

        foreach(Role::all() as $rol){
            foreach($permissions as $p){
                Permission::create(['name' => "{$rol->name} $p"]);
            }
        }

        $superadmin->syncPermissions(Permission::all());

       // $superadmin->assignRole('superadmin');
        //$admin->assignRole('admin');
        //$client->assignRole('client');
    }
}
