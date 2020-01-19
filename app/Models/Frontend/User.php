<?php

namespace App\Models\Frontend;

use App\Models\Backend\Admin;
use App\Models\Backend\Property\Property;
use App\Notifications\Frontend\FrontendResetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new FrontendResetPasswordNotification($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getEditButtonAttribute()
    {
        return '<a href="' . route('admin.front-user.edit', $this->id) . '" data-id="' . $this->id . '" class="btn green btn-outline btn-xs"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="javascript:void(0);"
                class="btn red btn-outline btn-xs deleteConfirmation" data-id="' . $this->id . '"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
    }

    public function getNameNumberAttribute()
    {
        return $this->id . '(' . $this->mobile_number . ')';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        $actionButton = '';

        if (auth()->guard('admin')->user()->can('Edit User')) {
            $actionButton .= $this->edit_button;
        }

        if (auth()->guard('admin')->user()->can('Delete User')) {
            $actionButton .= $this->delete_button;
        }

        return $actionButton;
    }

    public function getProfileImageUrlAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . ucfirst(substr($this->attributes['name'], 0, 1)) . '&background=0D8ABC&color=fff';
    }
}
