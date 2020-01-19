<?php

namespace App\Http\Controllers\Backend\User\Permission;

use App\Http\Controllers\Controller;
use App\Models\Backend\GlobalModules\Permission\Permission;
use App\Repositories\Backend\User\Permission\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{

    /**
     * @var PermissionRepository
     */
    protected $permissionRepo;

    /**
     * PermissionRepository constructor.
     * @param PermissionRepository $permission
     */
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->middleware('auth:admin');
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view('backend.user.permission.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('backend.user.permission.create');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param StorePermissionRequest $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $this->permissionRepo->create($request->only('name', 'status'));

            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.user.permission.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Permission $permission
     * @return mixed
     */
    public function edit(Permission $permission)
    {
        try {
            return view('backend.user.permission.edit')
                ->withPermission($permission);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param UpdatePermissionRequest $request
     * @param Permission $permission
     * @return mixed
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $this->permissionRepo->update($permission, $request->only(
                'name',
                'status'
            ));

            toastr()->success('Data has been updated successfully!');

            return redirect()->route('admin.user.permission.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Permission $permission
     * @return mixed
     */
    public function destroy(Request $request)
    {
        try {
            $permission = Permission::findOrFail($request->id);
            if ($permission->delete()) {
                return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Internal server error']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * @param Permission $permission
     * @return array
     * @throws \Exception
     */
    public function bulkDelete(Permission $permission)
    {
        try {
            $delete = $permission->whereIn('id', request('data'))->delete();
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
            $permission = Permission::findOrFail($Id);
            $permission->status = $permission->status == 1 ? 0 : 1;
            $permission->save();

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

            $permission = Permission::query()->whereIn('id', request('data'));

            switch ($actionType) {
                case '0':
                    $permission->update(['status' => 0]);
                    return response()->json(['success' => true, 'message' => 'In-Active record successfully']);
                    break;
                case '1':
                    $permission->update(['status' => 1]);
                    return response()->json(['success' => true, 'message' => 'Active record successfully']);
                    break;
                case '3':
                    $permission->delete();
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
