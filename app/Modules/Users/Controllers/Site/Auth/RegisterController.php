<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Users\Repositories\UsersRepository;
use App\Modules\Users\Services\UsersService;

class RegisterController extends Controller
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
     */
    public function __construct(UsersRepository $usersRepository, UsersService $usersService)
    {
        $this->repository  = $usersRepository;
        $this->service  = $usersService;
    }

    /**
     * It returns the view `admin.home`
     * @return A view called home.blade.php
     */
    public function register()
    {
        return view('admin.register');
    }

    /**
     * It validates the request, if it fails it returns the user to the previous page with the errors,
     * if it passes it registers the user and creates a session for success
     * 
     * @param Request request The request object.
     * 
     * @return The method is returning the view 'admin.home'
     */
    public function create(Request $request)
    {
        $validator = $this->service->validations($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $this->repository->register($request);

        $this->service->createSessionForSuccess();
        return redirect('admin/home');
    }
}
