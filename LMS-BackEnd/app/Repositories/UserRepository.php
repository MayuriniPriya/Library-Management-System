<?php


namespace App\Repositories;

use App\Models\User;
use \App\Contracts\Repositories\User as UserContract;

class UserRepository extends Repository implements UserContract
{
    /**
     * @var string
     */
    protected string $model = User::class;
}
