<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 20-Jan-19
 * Time: 4:30 PM
 */

return [

    'frontend'  => [

    ],

    'backend'  => [

        'global_modules' => [
            'property_type' => [
                'manage' => 'Manage Property Type',
                'create'     => 'Create Property Type',
                'edit'       => 'Edit Property Type',
                'table' => [
                    'name' => 'Name',
                    'type' => 'Type',
                    'created_at' => 'Created Date',
                    'updated_at' => 'Updated Date'
                ],
            ]
        ],
        'project' => [
            'manage' => 'Manage Project Model',
            'create'     => 'Create Project Model',
            'edit'       => 'Edit Project Model',
            'deleted'  => 'Data has been deleted',
            'table' => [
                'name' => 'Name',
                'type' => 'Type',
                'created_at' => 'Created Date',
                'updated_at' => 'Updated Date'
            ],
        ],
    ]
];
