<?php

namespace App\Http\Controllers\Backend\FrontUser;

use App\Http\Requests\StoreFrontUserRequest;
use App\Models\Frontend\UserPackage;
use Illuminate\Http\Request;
use App\Models\Frontend\User;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Backend\GlobalModules\Package\Package;
use App\Repositories\Backend\FrontUser\FrontUserRepository;

class FrontUserController extends Controller
{
    /**
     * @var FrontUserRepository
     */
    protected $frontUserRepo;

    /**
     * FrontUserRepository constructor.
     * @param FrontUserRepository $frontUser
     */
    public function __construct(FrontUserRepository $frontUserRepo)
    {
        $this->middleware('auth:admin');
        $this->frontUserRepo = $frontUserRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $packageLists = Package::all()->pluck('name', 'id')->toArray();

            return view('backend.front-user.index',compact('packageLists'));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function create()
    {
        try {
            $packageLists = Package::all()->pluck('name', 'id')->toArray();
            return view('backend.front-user.create', compact('packageLists'));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param StoreFrontUserRequest $request
     * @return mixed
     */
    public function store(StoreFrontUserRequest $request)
    {
        try {
            $data = $this->frontUserRepo->create($request->only(
                'name',
                'email',
                'alternate_email',
                'mobile_number',
                'alternate_mobile_number',
                'user_type',
                'package_id',
                'description',
                'password',
                'status',
                'profile_image'
            ));
            $message = 'Your Account is created in nproperty.in with email:' . $request->email;
            sendSms($request->mobile_no, $message);
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.front-user.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param FrontUser $frontUser
     * @return mixed
     */
    public function edit(User $frontUser)
    {
        try {
            $packageLists = Package::all()->pluck('name', 'id')->toArray();
            return view('backend.front-user.edit', compact('packageLists'))
                ->withFrontUser($frontUser);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param UpdateFrontUserRequest $request
     * @param User $frontUser
     * @return mixed
     */
    public function update(Request $request, User $frontUser)
    {
        try {
            $this->frontUserRepo->update($frontUser, $request->only(
                'name',
                'email',
                'alternate_email',
                'mobile_number',
                'alternate_mobile_number',
                'user_type',
                'package_id',
                'description',
                'password',
                'status',
                'icon'
            ));

            toastr()->success('Data has been updated successfully!');

            return redirect()->route('admin.front-user.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param User $frontUser
     * @return mixed
     */
    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            if ($user->delete()) {
                return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
            }
            return response()->json(['error' => true, 'message' => 'Internal server error']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }


    public function getJson(Request $request)
    {
        try {

            $userList = $this->frontUserRepo->query()->where('name', 'like', '%' . $request->search . '%')->get();

            $resp = [];
            foreach ($userList as $key => $val) {
                $resp[] = [
                    'id' => $val->id,
                    'text' => $val->name
                ];
            }
            return response()->json(['results' => $resp]);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function getUserPackageJson(Request $request)
    {
        try {

            $userList = $this->frontUserRepo->query()->where('id', $request->userId)->first();
            $packageList = UserPackage::where('user_id', $request->userId)->get();
            $resp = [];
            foreach ($packageList as $key => $val) {
                $resp[] = [
                    'id' => $val->id,
                    'text' => $val->package_name
                ];
            }
            return response()->json(['results' => $resp]);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param User $frontUser
     * @return array
     * @throws \Exception
     */
    public function bulkAction(Request $request)
    {
        try {
            $actionType = $request->action_type;

            $frontUser = User::query()->whereIn('id', request('data'));

            switch ($actionType) {
                case '0':
                    $frontUser->update(['status' => 0]);
                    return response()->json(['success' => true, 'message' => 'In-Active record successfully']);
                    break;
                case '1':
                    $frontUser->update(['status' => 1]);
                    return response()->json(['success' => true, 'message' => 'Active record successfully']);
                    break;
                case '3':
                    $frontUser->delete();
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
            $user = User::withoutGlobalScope('status')->findOrFail($Id);
            $user->status = $user->status == 1 ? 0 : 1;
            $user->save();

            return \response()->json(['success' => true, 'message' => 'Change status successfully']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return \response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }

    public function getPackageListBasedOnUserType(Request $request)
    {
        try {
            $packageLists = Package::where('user_type_id',$request->user_type)->get()->pluck('name','id')->toArray();

            return \response()->json(['success' => true, 'package_list' => $packageLists]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return \response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }
}
