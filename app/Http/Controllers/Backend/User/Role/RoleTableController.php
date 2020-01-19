<?php

namespace App\Http\Controllers\Backend\User\Role;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\User\Role\RoleRepository;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class RoleTableController extends Controller
{

    /**
     * @var RoleRepository
     */
    protected $roleRepo;

    /**
     * RoleTableController constructor.
     * @param RoleRepository $roleRepo
     */
    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        try {
            return DataTables::of($this->roleRepo->getForDataTable())
                ->addIndexColumn()
                ->addColumn('action', function ($role) {
                    $actionButton = '';
                    if (auth()->user()->is_superadmin == 1 || auth()->user()->can('Edit Role')) {
                        $actionButton .= '<a href="' . route('admin.user.role.edit', $role->id) . '" data-id="' . $role->id . '"
                             class="btn green btn-outline btn-xs"> <i class="fa fa-pencil-square-o" data-toggle="tooltip"
                              data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a>';
                    }
                    if (auth()->user()->is_superadmin == 1 || auth()->user()->can('Delete Role')) {
                        $actionButton .=
                            '<a href="javascript:void(0);"
                             class="btn red btn-outline btn-xs deleteConfirmation" data-id="' . $role->id . '"> <i class="fa fa-trash-o" data-toggle="tooltip" 
                             data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
                    }
                        return $actionButton;
                })
                ->addColumn('status',function($role){
                    return $role->status == 1
                        ? '<a href="javascript:void(0)" class="status" data-id="'.$role->id.'"><small class="badge badge-success" data-id="'.$role->id.'">Active</small></a>'
                        : '<a href="javascript:void(0)" class="status" data-id="'.$role->id.'"><small class="badge badge-danger">In-active</small></a>';
                })
                ->addColumn('created_by', function ($role) {
                    return !empty($role->createdBy->name) ? $role->createdBy->name : '';
                })
                ->rawColumns(['id','action','status', 'created_by'])
                ->make(true);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
