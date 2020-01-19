<?php

namespace App\Http\Controllers\Backend\FrontUser;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\FrontUser\FrontUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class FrontUserTableController extends Controller
{

    /**
     * @var FrontUserRepository
     */
    protected $frontUserRepo;

    /**
     * FrontUserTableController constructor.
     * @param FrontUserRepository $frontUserRepo
     */
    public function __construct(FrontUserRepository $frontUserRepo)
    {
        $this->middleware('auth:admin');
        $this->frontUserRepo = $frontUserRepo;
    }

    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        try {
            $dataTables = $this->frontUserRepo->getForDataTable();

            if (!empty($userType = $request->get('user_type'))) {
                $dataTables->where('user_type',$userType);
            }

            if (!empty($status = $request->has('status'))) {
                $dataTables->where('status',$status);
            }

            if (!empty($request->get('user_package'))) {
                $dataTables->whereHas('activePackage',function ($q) use ($request){
                    $q->where('package_id',$request->get('user_package'));
                });
            }

            return DataTables::of($dataTables)
                ->addIndexColumn()
                ->addColumn('parent_id',function($frontUser){
                    return isset($frontUser->parent_id)
                        ? config('backend.backend.frontUser_type.'.$frontUser->parent_id) : '-';
                })
                ->editColumn('user_type',function($frontUser){
                    return !empty($frontUser->user_type) ? config('backend.backend.package_user_type.'.$frontUser->user_type) : '-';
                })
                ->addColumn('live_property',function($frontUser){
                    return $frontUser->userProperty->count();
                })
                ->addColumn('response',function($frontUser){
                    return 0;
                })
                ->addColumn('created_at',function($frontUser){
                    return globalDateFormat($frontUser->created_at);
                })
                ->addColumn('action',function($frontUser){
                    return $frontUser->action_buttons;
                })
                ->addColumn('status',function($frontUser){
                    return $frontUser->status == 1
                        ? '<a href="javascript:void(0)" class="status" data-id="'.$frontUser->id.'"><small class="badge badge-success" data-id="'.$frontUser->id.'">Active</small></a>'
                        : '<a href="javascript:void(0)" class="status" data-id="'.$frontUser->id.'"><small class="badge badge-danger">In-active</small></a>';
                })
                ->addColumn('created_by', function ($frontUser) {
                    return !empty($frontUser->createdBy->name) ? $frontUser->createdBy->name : $frontUser->created_by;
                })
                ->rawColumns(['id','action','status'])
                ->make(true);
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
        }
    }
}
