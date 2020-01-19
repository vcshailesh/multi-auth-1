<?php

namespace App\Models\Backend\Permission\Traits\Relationship;

use App\Models\Backend\Admin;

/**
 * Trait RoleRelationship
 * @package App\Models\Backend\GlobalModules\Role\Traits\Relationship
 */
trait PermissionRelationship
{
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
