<?php

namespace App\Modules\Users\Services;


use App\Http\Services\Services;
use App\Modules\Users\Repositories\UsersRepository;
use Illuminate\Support\Facades\Validator;


class UsersService extends Services
{
    /**
     * Main Repository
     *
     * @var UsersRepository
     */
    protected ?UsersRepository $repository;

    /**
     * Constructor

     * @param UsersRepository $repository
     */
    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * It validates the request data.
     * 
     * @param request The request object.
     * 
     * @return A validator object
     */
    public function validations($request)
    {
        return Validator::make($request->all(), [
            'email' => ['required|unique:users,email'],
            'phone' => ['required|unique:users,phone'],
            'password' => [
                'required',
                'min:6',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
            ],
        ]);
    }

    /**
     * It validates the login form.
     * 
     * @param request The request object.
     * 
     * @return A validator object
     */
    public function validationLogin($request)
    {
        return Validator::make($request->all(), [
            'emailOrPhone' => ['required'],
            'password' => [
                'required',
                'min:6',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
            ],
        ]);
    }
}
