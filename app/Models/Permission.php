<?php

namespace App\Models;

use App\Core\Access\AccessPermission;

/**
 * Class Permission
 * @package App\Core\Models
 */
class Permission extends AccessPermission
{
    /**
     * bootable methods fix.
     */
    public static function boot()
    {
        parent::boot();
    }
}
