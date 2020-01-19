<?php

namespace App\Http\Controllers\Backend\AdminUser;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\AdminUser\AdminUserRepository;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AdminUserTableController extends Controller
{

    /**
     * @var AdminUserRepository
     */
    protected $adminUserRepo;

    /**
     * AdminUserTableController constructor.
     * @param AdminUserRepository $adminUserRepo
     */
    public function __construct(AdminUserRepository $adminUserRepo)
    {
        $this->adminUserRepo = $adminUserRepo;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        try {
            return DataTables::of($this->adminUserRepo->getForDataTable())
                ->addIndexColumn()
                ->addColumn('parent_id',function($adminUser){
                    return isset($adminUser->parent_id)
                            ? config('backend.backend.adminUser_type.'.$adminUser->parent_id) : '-';
                })
                ->addColumn('action',function($adminUser){
                    return $adminUser->action_buttons;
                })
                ->addColumn('status',function($adminUser){
                    return $adminUser->status == 1
                        ? '<a href="javascript:void(0)" class="status" data-id="'.$adminUser->id.'"><small class="badge badge-success" data-id="'.$adminUser->id.'">Active</small></a>'
                        : '<a href="javascript:void(0)" class="status" data-id="'.$adminUser->id.'"><small class="badge badge-danger">In-active</small></a>';
                })
                ->rawColumns(['id','action','status'])
                ->make(true);
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
        }
    }
}
