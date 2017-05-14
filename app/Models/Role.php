<?php

namespace App\Models;

use App\Core\Access\AccessRole;

/**
 * Class Role
 * @package App\Models
 */
class Role extends AccessRole
{

    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * bootable methods fix.
     */
    public static function boot()
    {
        parent::boot();
    }

    /**
     * @return array
     */
    public function getRoleIds()
    {
        $roleAdminArr = $this->users()->get();

        $adminArr = [];

        foreach ($roleAdminArr as $key => $admin) {
            $adminArr[] = $admin->id;
        }

        return array_values($adminArr);
    }

    /**
     * @param $query
     */
    public function scopeWhereAdmin($query)
    {
        $query->where('name', 'Admin');
    }

    /**
     * detach all permissions.
     */
    public function detachAllPermissions()
    {
        $this->perms()->sync([]);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getRoleUsers(string $name)
    {
        $user = new User();
        $roleUsers = $user->getUsersByRole($name);

        return $roleUsers;
    }
}
