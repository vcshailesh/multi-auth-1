<?php

namespace App\Models\Backend\Role\Traits\Attribute;
/**
 * Trait RoleAttribute
 * @package App\Models\Role\Traits\Attribute
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.role.edit',$this->id).'" data-id="'.$this->id.'" class="btn green btn-outline btn-xs"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a>';
    }
    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.role.destroy', $this->id).'"
                class="btn red btn-outline btn-xs"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a>';
    }
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {

        return $this->edit_button.
               $this->delete_button ;
    }
}
