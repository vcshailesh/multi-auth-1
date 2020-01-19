<?php

namespace App\Repositories\Backend\Permission;

use App\Models\Backend\Permission\Permission;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Support\Facades\Log;

class PermissionRepository extends BaseRepository
{

    const MODEL = Permission::class;
     

    /* @return mixed
     */
    
    public function getForDataTable()
    {
        try {
            return $this->query()
                ->select(['*'])->orderBy('id','desc');
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param array $data
     * @return Permission
     */
    public function create(array $data)
    {
        try {
            foreach (explode(',', $data['name']) as $typeKey => $type) {
                $permission = $this->createPermissionStub($data, $type);
                DB::transaction(function () use ($data, $permission) {
                    if ($permission->save()) {
                        return $permission;
                    }
                });
            }
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Permission $permission
     * @param array $data
     * @return Permission
     */
    public function update($permission, array $data)
    {
        try {
            $permission->name = isset($data['name']) ? $data['name'] : null;
            $permission->status = isset($data['status']) ? $data['status'] : null;
            DB::transaction(function () use ($permission, $data) {
                if ($permission->save()) {
                    return $permission;
                }
            });
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function createPermissionStub($input, $type)
    {
        try {
            $permission = self::MODEL;
            $permission = new $permission;
            $permission->name = !empty($input['name']) ? $type : null;
            $permission->status= !empty($input['status']) ?  $input['status'] : false;
            return $permission;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
