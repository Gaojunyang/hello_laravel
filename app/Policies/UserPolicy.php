<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
        //第一个参数默认为当前登录用户实例，第二个参数则为要进行授权的用户实例
        return $currentUser->id === $user->id;
    }

    public function destroy(User $currentUser, User $user)
    {
        //只有当前用户拥有管理员权限且删除的用户不是自己时才显示链接
        return $currentUser->is_admin && $currentUser->id != $user->id;
    }
}
