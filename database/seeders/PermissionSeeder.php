<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            'read',
            'create',
            'delete',
            'update'
        ];
for ($i =0; $i < count($actions) ; $i++  ){
    Permission::create([
        'name' => 'users-'. $actions[$i]
    ])->assignRole('super_admin');
}
}

}
