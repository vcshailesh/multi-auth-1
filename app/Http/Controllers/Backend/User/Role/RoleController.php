<?php

namespace App\Http\Controllers\Backend\User\Role;

use App\Http\Controllers\Controller;
use App\Models\Backend\GlobalModules\Role\Role;
use App\Repositories\Backend\User\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\Backend\User\Permission\PermissionRepository;

class RoleController extends Controller
{

    /**
     * @var RoleRepository
     */
    protected $roleRepo;
    protected $permissionRepo;

    /**
     * RoleRepository constructor.
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $roleRepo,PermissionRepository $permissionRepo)
    {
        $this->middleware('auth:admin');
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view('backend.user.role.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function create()
    {
        try {

            $permissions = $this->permissionRepo->getAll();

            return view('backend.user.role.create',compact("permissions"));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param StoreRoleRequest $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {

            $this->roleRepo->create($request->only(
                'name','permissions'
            ));

            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.user.role.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Role $role
     * @return mixed
     */
    public function edit(Role $role)
    {
        try {
            $permissions = $this->permissionRepo->getAll();
            $roleData = $this->roleRepo->edit($role);
            $roleAssignedPermission = $roleData->permissions->pluck('id')->toArray();
            return view('backend.user.role.edit', compact("permissions", "roleData",'roleAssignedPermission'))
                ->withRole($role);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return mixed
     */
    public function update(Request $request, Role $role)
    {
        try {
            $this->roleRepo->update($role, $request->only(
                'name','permissions'
            ));

            toastr()->success('Data has been updated successfully!');

            return redirect()->route('admin.user.role.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Role $role
     * @return mixed
     */
    public function destroy(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);
            if ($role->delete()) {
                return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Internal server error']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * @param Role $role
     * @return array
     * @throws \Exception
     */
    public function bulkDelete(Role $role)
    {
        try {
            $delete = $role->whereIn('id', request('data'))->delete();
            if ($delete) {
                return [
                    'success' => '1',
                    'message' => 'Your choosen records has been deleted.'
                ];
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $Id = $request->id;
            $role = Role::findOrFail($Id);
            $role->status = $role->status == 1 ? 0 : 1;
            $role->save();

            return \response()->json(['success' => true,'message' => 'Change status successfully']);
        }catch(\Exception $ex){
            Log::error($ex->getMessage());
            return \response()->json(['error' => true,'message' => $ex->getMessage()]);
        }
    }

    public function bulkAction(Request $request)
    {
        try {
            $actionType = $request->action_type;

            $role = Role::query()->whereIn('id', request('data'));

            switch ($actionType) {
                case '0':
                    $role->update(['status' => 0]);
                    return response()->json(['success' => true, 'message' => 'In-Active record successfully']);
                    break;
                case '1':
                    $role->update(['status' => 1]);
                    return response()->json(['success' => true, 'message' => 'Active record successfully']);
                    break;
                case '3':
                    $role->delete();
                    return response()->json(['success' => true, 'message' => 'Delete record successfully']);
                    break;
                default:
                    return response()->json(['error' => true, 'message' => 'No action']);
                    break;
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
