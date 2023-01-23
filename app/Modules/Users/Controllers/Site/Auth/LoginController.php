<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Users\Repositories\UsersRepository;
use App\Modules\Users\Services\UsersService;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
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
    public function login()
    {
        return view('admin.login');
    }

    /**
     * Admin login.
     *
     * @param Request $request
     * @return string
     */
    public function findForLogin(Request $request)
    {
        $validator = $this->service->validationLogin($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $login =  $this->repository->findForLogin($request->only(['emailOrPhone', 'password']));
        if (!$login) {
            $this->service->createSessionForFail();
            return back();
        }
        Session::put('admin', true);
        $this->service->createSessionForSuccess();
        return redirect('admin/home');
    }
}
