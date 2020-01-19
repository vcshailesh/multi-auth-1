<?php

namespace App\Repositories\Backend\FrontUser;

use App\Models\Backend\GlobalModules\Package\Package;
use App\Models\Frontend\UserPackage;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;
use App\Models\Frontend\User;
use Illuminate\Support\Facades\Hash;

class FrontUserRepository extends BaseRepository
{

    const MODEL = User::class;

    /* @return mixed
     */
    public function getForDataTable()
    {
        try {
            return $this->query()
                ->select(['*'])->withoutGlobalScopes()->orderBy('id', 'desc');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param array $data
     * @return PropertyType
     */
    public function create(array $data)
    {
        try {

            $frontUser = $this->createFrontUserStub($data);
            DB::transaction(function () use ($data, $frontUser) {
                if ($frontUser->save()) {
                    $id = $frontUser->id;
                    if (!empty($data['profile_image'])) {
                        $imageName = $data['profile_image']->getClientOriginalName();
                        $data['profile_image']->move(public_path('/assets/backend/images/front-user/'), $imageName);
                    }
                    foreach ($data['package_id'] as $package) {
                        $packageInfo = Package::findOrFail($package);
                        $userPackage = new UserPackage();
                        $userPackage->user_id = $id;
                        $userPackage->package_id = !empty($package) ? $package : null;
//                        $userPackage->package_id = !empty($package) ? $package->id : null;
                        $userPackage->total_limit = !empty($packageInfo->property_limit) ? $packageInfo->property_limit : null;
                        $userPackage->expiry_date = !empty($packageInfo->expired_at) ? Carbon::now()->addDays($packageInfo->expired_at) : null;
                        $userPackage->toal_posted_property = 0;
                        $userPackage->status = true;
                        $userPackage->save();
                    }
                    return $frontUser;
                }
            });
        } catch (\Exception $ex) {

            Log::error($ex->getMessage());
        }
    }

    /**
     * @param FrontUser $frontUser
     * @param array $data
     * @return FrontUser
     */
    public function update($frontUser, array $data)
    {
        try {

            $updateFrontUser = $this->updateFrontUserStub($frontUser, $data);

            DB::transaction(function () use ($updateFrontUser, $data) {
                if ($updateFrontUser->save()) {
                    if (isset($data['profile_image'])) {
                        $imageName = $data['profile_image']->getClientOriginalName();
                        $data['profile_image']->move(public_path('/assets/backend/images/front-user/'), $imageName);
                    }

                    foreach ($data['package_id'] as $package) {
                        $packageInfo = Package::findOrFail($package);
                        $userPackage = UserPackage::updateOrCreate(['user_id' => $updateFrontUser->id, 'package_id' => $package], [
                            'user_id' => !empty($updateFrontUser) ? $updateFrontUser->id : null,
                            'package_id' => !empty($package) ? $package : null,
                            'total_limit' => !empty($packageInfo->property_limit) ? $packageInfo->property_limit : null,
                            'expiry_date' => !empty($packageInfo->expired_at) ? Carbon::now()->addDays($packageInfo->expired_at) : null,
                            'toal_posted_property' => 0,
                            'status' => true
                        ]);
                    }

                    return $updateFrontUser;
                }
            });
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }


    public function frontUpdate($frontUser, array $input)
    {
        try {

            $frontUser->name = isset($input['name']) ? $input['name'] : null;
            $frontUser->alternate_email = isset($input['alternate_email']) ? $input['alternate_email'] : null;
            $frontUser->alternate_mobile_number = isset($input['alternate_mobile_number']) ? $input['alternate_mobile_number'] : null;
            $frontUser->description = isset($input['description']) ? $input['description'] : null;

            if (isset($input['icon'])) {
                $frontUser->icon = $input['icon']->getClientOriginalName();
            }

            DB::transaction(function () use ($frontUser, $input) {
                if ($frontUser->save()) {
                    if (isset($input['icon'])) {
                        $imageName = $input['icon']->getClientOriginalName();
                        $input['icon']->move(public_path('/assets/backend/images/front-user/'), $imageName);
                    }

                    return $frontUser;
                }
            });
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function changePassword($frontUser, array $input)
    {
        try {

            $frontUser->password = Hash::make($input['password']);

            DB::transaction(function () use ($frontUser, $input) {
                if ($frontUser->save()) {
                    return $frontUser;
                }
            });

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function createFrontUserStub($input)
    {
        try {

            $frontUser = self::MODEL;
            $frontUser = new $frontUser;

            $frontUser->name = !empty($input['name']) ? $input['name'] : null;
            $frontUser->email = !empty($input['email']) ? $input['email'] : null;
            $frontUser->alternate_email = !empty($input['alternate_email']) ? $input['alternate_email'] : null;
            $frontUser->user_type = !empty($input['user_type']) ? $input['user_type'] : null;
            $frontUser->package_id = !empty($input['package_id']) ? implode(',', $input['package_id']) : null;
            $frontUser->mobile_number = !empty($input['mobile_number']) ? $input['mobile_number'] : null;
            $frontUser->alternate_mobile_number = !empty($input['alternate_mobile_number']) ? $input['alternate_mobile_number'] : null;
            $frontUser->description = !empty($input['description']) ? $input['description'] : null;
            $frontUser->status = !empty($input['status']) ? $input['status'] : null;
            $frontUser->icon = !empty($input['profile_image']) ? $input['profile_image']->getClientOriginalName() : null;
            $frontUser->password = !empty($input['password']) ? bcrypt($input['password']) : bcrypt('nproperty@123');
            $frontUser->show_password = !empty($input['password']) ? $input['password'] : 'nproperty@123';
            $frontUser->created_by = auth()->id();

            return $frontUser;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function updateFrontUserStub($frontUser, $input)
    {
        try {

            $frontUser->name = !empty($input['name']) ? $input['name'] : null;
            $frontUser->email = !empty($input['email']) ? $input['email'] : null;
            $frontUser->alternate_email = !empty($input['alternate_email']) ? $input['alternate_email'] : null;
            $frontUser->user_type = !empty($input['user_type']) ? $input['user_type'] : null;
            $frontUser->package_id = !empty($input['package_id']) ? implode(',', $input['package_id']) : null;
            $frontUser->mobile_number = !empty($input['mobile_number']) ? $input['mobile_number'] : null;
            $frontUser->alternate_mobile_number = !empty($input['alternate_mobile_number']) ? $input['alternate_mobile_number'] : null;
            $frontUser->description = !empty($input['description']) ? $input['description'] : null;
            $frontUser->status = !empty($input['status']) ? $input['status'] : null;
            $frontUser->icon = !empty($input['profile_image']) ? $input['profile_image']->getClientOriginalName() : null;
            $frontUser->password = !empty($input['password']) ? bcrypt($input['password']) : $frontUser->password;
            $frontUser->show_password = !empty($input['password']) ? $input['password'] : null;
            return $frontUser;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function updateFrontUserStub2($frontUser, $input)
    {
        try {

            $frontUser->name = isset($input['name']) ? $input['name'] : null;
            $frontUser->alternate_email = isset($input['alternate_email']) ? $input['alternate_email'] : null;
            $frontUser->alternate_mobile_number = isset($input['alternate_mobile_number']) ? $input['alternate_mobile_number'] : null;
            $frontUser->description = isset($input['description']) ? $input['description'] : null;

            if (isset($input['icon'])) {
                $frontUser->icon = $input['icon']->getClientOriginalName();
            }

            return $frontUser;

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
