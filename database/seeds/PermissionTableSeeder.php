<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \Illuminate\Support\Facades\DB::table('permissions')->insert([
                [
                    'name' => 'Manage Users',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Create User',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Edit User',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Delete User',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Back Users',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Manage Admin User',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Create Admin User',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Edit Admin User',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Delete Admin User',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Manage Role',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Create Role',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Edit Role',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Delete Role',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Manage Permission',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Create Permission',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Edit Permission',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],[
                    'name' => 'Delete Permission',
                    'guard_name' => 'admin',
                    'status' => '1'
                ],
            ]);
        }catch (\Exception $ex){
            \Illuminate\Support\Facades\Log::error($ex->getMessage());
        }
    }
}
