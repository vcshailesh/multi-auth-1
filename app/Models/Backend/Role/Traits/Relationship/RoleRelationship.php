<?php

namespace App\Models\Backend\Role\Traits\Relationship;

use App\Models\Backend\Admin;

/**
 * Trait RoleRelationship
 * @package App\Models\Backend\Role\Traits\Relationship
 */
trait RoleRelationship
{
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
