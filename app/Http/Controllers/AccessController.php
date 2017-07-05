<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * @var Role
     */
    private $role;
    /**
     * @var Permission
     */
    private $permission;
    /**
     * @var User
     */
    private $user;

    /**
     * AccessController constructor.
     * @param Role $role
     * @param Permission $permission
     * @param User $user
     */
    public function __construct(Role $role, Permission $permission, User $user)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->user = $user;
    }
}
