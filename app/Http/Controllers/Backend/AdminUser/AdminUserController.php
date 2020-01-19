<?php

namespace App\Http\Controllers\Backend\AdminUser;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\AdminUser\AdminUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\Backend\User\Role\RoleRepository;
use App\Models\Backend\Admin;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{

    /**
     * @var AdminUserRepository
     */
    protected $adminUserRepo;
    protected $roleRepo;

    /**
     * AdminUserRepository constructor.
     * @param AdminUserRepository $adminUser
     */
    public function __construct(AdminUserRepository $adminUserRepo,RoleRepository $roleRepo)
    {
        $this->middleware('auth:admin');
        $this->adminUserRepo = $adminUserRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view('backend.admin-user.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function create()
    {
        try {
            $roles = $this->roleRepo->getAll()->pluck('name','id');
            return view('backend.admin-user.create',compact("roles"));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param StoreAdminUserRequest $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
        
            // return  $request->all();
            
            $data= $this->adminUserRepo->create($request->only(                
                'name',
                'email',            
                'mobile_number',            
                'user_type',                
                'password',
                'status',
                'icon'
            ));
            
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.admin-user.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param AdminUser $adminUser
     * @return mixed
     */
    public function edit(Admin $adminUser)
    {
        try {               
            $roles = $this->roleRepo->getAll()->pluck('name','id');
            return view('backend.admin-user.edit',compact("roles"))->withAdminUser($adminUser);            
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param UpdateAdminUserRequest $request
     * @param Admin $adminUser
     * @return mixed
     */
    public function update(Request $request, Admin $adminUser)
    {
        try {
            $this->adminUserRepo->update($adminUser, $request->only(
                'name',
                'email',            
                'mobile_number',            
                'user_type',                
                'password',
                'status',
                'icon'
            ));

            toastr()->success('Data has been updated successfully!');

            return redirect()->route('admin.admin-user.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Admin $adminUser
     * @return mixed
     */
    public function destroy(Request $request)
    {
        try {
            $adminUser = Admin::findOrFail($request->id);
            if ($adminUser->delete()) {
                return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Internal server error']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * @param Admin $adminUser
     * @return array
     * @throws \Exception
     */
    public function bulkDelete(Admin $adminUser)
    {
        try {
            $delete = $adminUser->whereIn('id', request('data'))->delete();
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

    public function bulkAction(Request $request)
    {
        try {
            $actionType = $request->action_type;

            $admin = Admin::query()->whereIn('id', request('data'));

            switch ($actionType) {
                case '0':
                    $admin->update(['status' => 0]);
                    return response()->json(['success' => true, 'message' => 'In-Active record successfully']);
                    break;
                case '1':
                    $admin->update(['status' => 1]);
                    return response()->json(['success' => true, 'message' => 'Active record successfully']);
                    break;
                case '3':
                    $admin->delete();
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

    public function changeStatus(Request $request)
    {
        try {
            $Id = $request->id;
            $admin = Admin::findOrFail($Id);
            $admin->status = $admin->status == 1 ? 0 : 1;
            $admin->save();

            return \response()->json(['success' => true,'message' => 'Change status successfully']);
        }catch(\Exception $ex){
            Log::error($ex->getMessage());
            return \response()->json(['error' => true,'message' => $ex->getMessage()]);
        }
    }
}
