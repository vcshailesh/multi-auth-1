<?php

namespace App\Repositories\Backend\Role;

use App\Models\Backend\Role\Role;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Support\Facades\Log;

class RoleRepository extends BaseRepository
{

    const MODEL = Role::class;


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
     * @return Role
     */
    public function create(array $data)
    {
        try {
            foreach(explode(',',$data['name']) as $typeKey => $type){
                $role = $this->createRoleStub($data,$type);
                DB::transaction(function () use ($data,$role) {
                    if ($role->save()) {
                        $role->syncPermissions($data['permissions']);
                        return $role;
                    }
                });
            }

        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
        }
    }

    public function edit($role)
    {
        $data = Role::with('permissions')->findOrFail($role->id);
        return $data;
    }
    /**
     * @param Role $role
     * @param array $data
     * @return Role
     */
    public function update($role, array $data)
    {
        try {
            $role->name = isset($data['name']) ? $data['name'] : null;
            DB::transaction(function () use ($role, $data) {
                if ($role->save()) {
                    $role->syncPermissions($data['permissions']);
                    return $role;
                }
            });
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function createRoleStub($input, $type)
    {
        try {
            $role = self::MODEL;
            $role = new $role;
            $role->name = isset($input['name']) ? $type : null;
            return $role;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
