<?php

namespace App\Modules\Tasks\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Tasks\Repositories\TasksRepository;
use App\Modules\Tasks\Services\TasksService;
use App\Modules\Tasks\Resources\TasksResource as Resource;

class TasksController extends Controller
{
    /* Declaring a variable that will be used to store the repository that will be injected into the
    class. */
    public $repository;
    /* Declaring a variable that will be used to store the service that will be injected into the
    class. */
    public $service;

    /**
     * The function __construct() is a magic method that is called when a new object is created. It is
     * used to initialize the object's properties
     *
     * @param TasksRepository TasksRepository This is the repository that will be used to access
     * the database.
     * @param TasksService TasksService This is the service class that will be used to perform the
     * business logic.
     */
    public function __construct(TasksRepository $usersRepository, TasksService $usersService)
    {
        $this->repository  = $usersRepository;
        $this->service  = $usersService;
    }
    /**
     * It returns a collection of all the Tasks in the database
     *
     * @param Request request This is the request object that is sent to the API.
     *
     * @return A collection of all the Tasks in the database.
     */
    public function index(Request $request)
    {
        return Resource::collection($this->repository->list());
    }

    /**
     * > This function returns the result of the `get` function in the `repository` class
     *
     * @param Request request The request object
     * @param id The id of the resource to be retrieved.
     *
     * @return The repository is being called to get the id of the user.
     */
    public function show(Request $request, $id)
    {
        $getSchool = $this->repository->get($id);

        if (!$getSchool) {
            return $this->service->notFound();
        }
        return $this->service->success($getSchool);
    }
}
