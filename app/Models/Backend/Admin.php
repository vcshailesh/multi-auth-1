<?php

namespace App\Models\Backend;

use App\Notifications\Backend\AdminResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'admin';

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'show_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getProfileImageUrlAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . ucfirst(substr($this->attributes['name'], 0, 1)) . '&background=0D8ABC&color=fff';
    }

    public function getEditButtonAttribute()
    {
        return '<a href="' . route('admin.admin-user.edit', $this->id) . '" data-id="' . $this->id . '" class="btn green btn-outline btn-xs"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="javascript:void(0);"
                class="btn red btn-outline btn-xs deleteConfirmation" data-id="' . $this->id . '"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        $actionButton = '';

        if (auth()->user()->is_superadmin == 1 || auth()->guard('admin')->user()->can('Edit Admin User')) {
            $actionButton .= $this->edit_button;
        }

        if (auth()->user()->is_superadmin == 1 || auth()->guard('admin')->user()->can('Delete Admin User')) {
            $actionButton .= $this->delete_button;
        }

        return $actionButton;
    }

}
