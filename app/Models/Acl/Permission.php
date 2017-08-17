<?php

namespace App\Models\Acl;

use App\Models\User\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Permission extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ACL_permission';
    
}