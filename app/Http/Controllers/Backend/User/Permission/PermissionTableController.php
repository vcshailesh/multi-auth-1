<?php

namespace App\Http\Controllers\Backend\User\Permission;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\User\Permission\PermissionRepository;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PermissionTableController extends Controller
{

    /**
     * @var PermissionRepository
     */
    protected $permissionRepo;

    /**
     * PermissionTableController constructor.
     * @param PermissionRepository $permissionRepo
     */
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        try {
            return DataTables::of($this->permissionRepo->getForDataTable())
                ->addIndexColumn()
                ->addColumn('action', function ($permission) {
                    $action = '';
                    if (auth()->user()->is_superadmin == 1 || auth()->user()->can('Edit Permission')) {
                        $action .=
                            '<a href="' . route('admin.user.permission.edit', $permission->id) . '" 
                        data-id="' . $permission->id . '" class="btn green btn-outline btn-xs"> 
                        <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top"
                        title="' . trans('buttons.general.crud.edit') . '"></i></a>';
                    }
                    if (auth()->user()->is_superadmin == 1 || auth()->user()->can('Delete Permission')) {
                        $action .=
                            '<a href="javascript:void(0)"
                        class="btn red btn-outline btn-xs deleteConfirmation" data-id="'.$permission->id.'"><i class="fa fa-trash-o" data-toggle="tooltip" 
                         data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a>';
                    }
                    return $action;
                })
                ->addColumn('status', function($permission) {
                    return $permission->status == 1
                        ? '<a href="javascript:void(0)" class="status" data-id="'.$permission->id.'"><small class="badge badge-success" data-id="'.$permission->id.'">Active</small></a>'
                        : '<a href="javascript:void(0)" class="status" data-id="'.$permission->id.'"><small class="badge badge-danger">In-active</small></a>';
                })
                ->addColumn('created_by', function ($permission) {
                    return !empty($permission->createdBy->name) ? $permission->createdBy->name : '';
                })
                ->rawColumns(['id','action','status','created_by'])
                ->make(true);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
