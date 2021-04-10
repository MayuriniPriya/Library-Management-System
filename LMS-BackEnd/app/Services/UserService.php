<?php

namespace App\Services;

use App\Contracts\Services\User as UserContract;
use App\Contracts\Repositories\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService extends Service implements UserContract
{
    /**
     * Create a new service instance.
     *
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->resource = $user;
    }

    public function create(array $values)
    {
        if ($password = Arr::get($values, 'password')) {
            $values = array_merge($values, ['password' => Hash::make($password)]);
        }
        return $this->resource->create(Arr::only($values, ['name', 'email', 'password']));
    }

    public function update($resourceId, array $values)
    {
        if ($password = Arr::get($values, 'password')) {
            $values = array_merge($values, ['password' => Hash::make($password)]);
        }

        $user = $this->find($resourceId);
        return $user->update(Arr::only($values, ['name', 'email', 'password']));
    }
}
