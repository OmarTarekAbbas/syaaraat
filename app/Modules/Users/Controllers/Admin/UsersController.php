<?php

namespace App\Modules\Users\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Users\Repositories\UsersRepository;
use App\Modules\Users\Requests\StoreUsersRequest;
use App\Modules\Users\Requests\UpdateUsersRequest;
use App\Modules\Users\Services\UsersService;
use App\Modules\Users\Resources\UsersResource as Resource;

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
    public $storeRequest;
    /* Declaring a variable that will be used to store the request class that will be injected into the
    class. */
    public $updateRequest;
    /**
     * The constructor function is used to inject the dependencies of the class
     * 
     * @param UsersRepository UsersRepository This is the repository that will be used to access
     * the database.
     * @param UsersService UsersService This is the service class that will be used to perform the
     * CRUD operations.
     * @param StoreSchoolRequest storeRequest This is the request class that will be used to validate
     * the data before it is stored in the database.
     * @param UpdateSchoolRequest updateRequest This is the request class that will be used to validate
     * the data before updating the school.
     */
    public function __construct(UsersRepository $usersRepository, UsersService $usersService, StoreUsersRequest $storeUsersRequest, UpdateUsersRequest $updateUsersRequest)
    {
        $this->repository  = $usersRepository;
        $this->service  = $usersService;
        $this->storeRequest  = $storeUsersRequest;
        $this->updateRequest  = $updateUsersRequest;
        
    }


    /**
     * It returns a view with a list of admins
     * 
     * @param Request request The request object.
     * 
     * @return A view called admin.list with a variable called admins
     */
    public function index(Request $request)
    {
        $admins = $this->repository->list();
        return view('admin.list', compact('admins'));
    }

    /**
     * The function home() returns the view admin.home
     * 
     * @return The view admin.home
     */
    public function home()
    {
        return view('admin.home');
    }
}
