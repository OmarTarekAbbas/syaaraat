<?php

namespace App\Modules\Users\Traits\Auth;

use Exception;
use App\Modules\Users\{
    Models\User as Model,
};
use Illuminate\Support\Facades\Hash;
// use App\Modules\Users\Repositories\UsersRepository;

trait FindForLogin
{
    /**
     * @var array
     */
    private array $credentials;

    /**
     * @var string
     */
    private string $column;
    /**
     * Find user and check user password to login.
     *
     * @param array $credentials
     * @return Model|null
     * @throws Exception
     */
    public function findForLogin(array $credentials): ?Model
    {
        if (is_numeric($credentials['emailOrPhone'])) {
            $user = Model::where('phone', $credentials['emailOrPhone'])->first();
        } else {
            $user = Model::where('email', $credentials['emailOrPhone'])->first();
        }
        if (!$user) {
            return null;
        }
        $password = $this->isMatchingPassword($user['password'], $credentials['password']);
        if (!$password) {
            return null;
        }

        return $user;
    }

    /**
     * Check if the given password is matching the current one
     *
     * @param  string $password
     * @return bool
     */
    public function isMatchingPassword($userPassword, $password): bool
    {
        return Hash::check($password, $userPassword);
    }
}
