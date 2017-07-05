<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Role::find(1)) {
            Role::create([
                'name'         => 'Admin',
                'display_name' => 'admin',
                'description'  => '', // optional
            ]);

            Role::create([
                'name'         => 'Employee',
                'display_name' => 'employee',
                'description'  => '', // optional
            ]);
            Role::create([
                'name'         => 'Employer',
                'display_name' => 'employer',
                'description'  => '', // optional
            ]);
        }

        if (!Permission::find(1)) {
            $permissionsAdmin = [
                'All of the above',
                'Delete Users',
                'Manage AdminPanel',
                'Manage Vacancies',
                'Manage Users',
                'Can Add',
                'Can Edit',
                'Can Delete',
                'Can Update',
                'Delete vacancy',
                'Create vacancy',
                'Hire employers'
            ];
            foreach ($permissionsAdmin as $permission) {
                $perm = Permission::updateOrCreate([
                    'name'         => $permission,
                    'display_name' => $permission,
                    'description'  => $permission,
                ]);
                $roleSAdmin = Role::find(1);

                $roleSAdmin->attachPermission($perm, new Role());
            }
            $listIds = Permission::all()->pluck('id');

            $roleClient = Role::find(2);
            foreach ($listIds as $key => $permission) {
                if ($key >= 10 && $key <= 11) {
                    $roleClient->attachPermission(Permission::find($permission));
                }
            }
        }
    }
}
