<?php

use App\Models\Backend\Admin;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $data = [
                [
                    'is_superadmin' => 1,
                    'email' => 'super@administrator.com',
                    'password' => bcrypt('Admin@123'),
                    'name' => 'Super Admin'
                ],
            ];

            $admin = Admin::insert($data);
        }catch (\Exception $ex){
            \Illuminate\Support\Facades\Log::error($ex->getMessage());
        }
    }
}
