<?php

namespace App\Modules\Users\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Modules\Users\Repositories\UsersRepository;
use App\Modules\Users\Services\UsersService;

class UsersController extends Controller
{
    /* Declaring a variable that will be used to store the repository that will be injected into the
    class. */
    public $repository;
    /* Declaring a variable that will be used to store the service that will be injected into the
    class. */
    public $service;
    /* Declaring a variable that will be used to store the request class that will be injected into the
    class. */
    /**
     * The function __construct() is a magic method that is called when a new object is created. It is
     * used to initialize the object's properties
     *
     * @param UsersRepository UsersRepository This is the repository that will be used to access
     * the database.
     * @param UsersService UsersService This is the service class that will be used to perform the
     * business logic.
     */
    public function __construct(UsersRepository $usersRepository, UsersService $usersService)
    {
        $this->repository  = $usersRepository;
        $this->service  = $usersService;
    }
   
}
