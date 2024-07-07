<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function show(User $user)
    {
        return $user;
    }

     public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

}
