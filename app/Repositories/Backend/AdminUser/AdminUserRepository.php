<?php

namespace App\Repositories\Backend\AdminUser;

use App\Repositories\BaseRepository;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Backend\Admin;
use Spatie\Permission\Models\Role;

class AdminUserRepository extends BaseRepository
{

    const MODEL = Admin::class;

    /* @return mixed
     */
    public function getForDataTable()
    {
        try {
            return $this->query()
                ->select(['*'])->orderBy('id','desc');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param array $data
     * @return PropertyType
     */
    public function create(array $data)
    {
        try {

            $adminUser = $this->createAdminUserStub($data);            
            DB::transaction(function () use ($data, $adminUser) {
                if ($adminUser->save()) {
                    $adminUser->syncRoles($data['user_type']); 
                    if (!empty($data['icon'])) {
                        $imageName = $data['icon']->getClientOriginalName();
                        $data['icon']->move(public_path('/assets/backend/images/admin-user/'), $imageName);
                    }
                    return $adminUser;
                }
            });
        } catch (\Exception $ex) {
    
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param AdminUser $adminUser
     * @param array $data
     * @return AdminUser
     */
    public function update($adminUser, array $data)
    {
        try {

            $updateAdminUser = $this->updateAdminUserStub($adminUser, $data);

            DB::transaction(function () use ($updateAdminUser, $data) {
                if ($updateAdminUser->save()) {                                    
                    $updateAdminUser->syncRoles($data['user_type']); 
                    if (!empty($data['icon'])) {
                        $imageName = $data['icon']->getClientOriginalName();
                        $data['icon']->move(public_path('/assets/backend/images/admin-user/'), $imageName);
                    }

                    return $updateAdminUser;
                }
            });
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function createAdminUserStub($input)
    {
        try {
            
            $adminUser = self::MODEL;
            $adminUser = new $adminUser;

            $adminUser->name = !empty($input['name']) ? $input['name'] : null;
            $adminUser->email = !empty($input['email']) ? $input['email'] : null;
            $adminUser->mobile_number = !empty($input['mobile_number']) ? $input['mobile_number'] : null;
            $adminUser->status = !empty($input['status']) ? $input['status'] : null;
            $adminUser->icon = !empty($input['icon']) ? $input['icon']->getClientOriginalName() : null;
            $adminUser->password = !empty($input['password']) ? Hash::make($input['password']) : null;
            $adminUser->show_password = !empty($input['password']) ? $input['password'] : null;
            
            return $adminUser;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function updateAdminUserStub($adminUser, $input)
    {
        try {

            $adminUser->name = !empty($input['name']) ? $input['name'] : null;
            $adminUser->email = !empty($input['email']) ? $input['email'] : null;
            $adminUser->show_password = !empty($input['password']) ? $input['password'] : null;
            $adminUser->mobile_number = !empty($input['mobile_number']) ? $input['mobile_number'] : null;
            $adminUser->status = !empty($input['status']) ? $input['status'] : null;
            $adminUser->icon = !empty($input['icon']) ? $input['icon']->getClientOriginalName() : null;
            
            return $adminUser;

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
