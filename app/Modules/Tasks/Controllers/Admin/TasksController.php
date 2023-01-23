<?php

namespace App\Modules\Tasks\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Tasks\Repositories\TasksRepository;
use App\Modules\Employees\Repositories\EmployeesRepository;
use App\Modules\Tasks\Requests\StoreTasksRequest;
use App\Modules\Tasks\Requests\UpdateTasksRequest;
use App\Modules\Tasks\Services\TasksService;

class TasksController extends Controller
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
    /* Declaring a variable that will be used to store the repository that will be injected into the
    class. */
    public $employeesRepository;

    /**
     * The constructor function is used to inject the dependencies of the class
     * 
     * @param TasksRepository TasksRepository This is the repository that will be used to access
     * the database.
     * @param TasksService TasksService This is the service class that will be used to perform the
     * CRUD operations.
     * @param StoreSchoolRequest storeRequest This is the request class that will be used to validate
     * the data before it is stored in the database.
     * @param UpdateSchoolRequest updateRequest This is the request class that will be used to validate
     * the data before updating the school.
     */
    public function __construct(TasksRepository $tasksRepository, TasksService $tasksService, StoreTasksRequest $storeTasksRequest, UpdateTasksRequest $updateTasksRequest, EmployeesRepository $employeesRepository)
    {
        $this->repository  = $tasksRepository;
        $this->employeesRepository  = $employeesRepository;
        $this->service  = $tasksService;
        $this->storeRequest  = $storeTasksRequest;
        $this->updateRequest  = $updateTasksRequest;
        
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
        $tasks = $this->repository->list();
        return view('admin.tasks.list', compact('tasks'));
    }

    /**
     * It returns a view called `admin.tasks.input`
     * 
     * @return The view 'admin.tasks.input'
     */
    public function create(Request $request)
    {
        $employees = $this->employeesRepository->list();
        return view('admin.tasks.input', compact('employees'));
    }

    /**
     * It validates the request, creates a new department, and redirects to the tasks page
     * 
     * @param Request request The request object.
     * 
     * @return The method is returning the view of the tasks.
     */
    public function store(Request $request)
    {
        $validator = $this->service->validations($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $create = $this->repository->create($request);
        if ($create) {
            $this->service->createSessionForSuccess();
            return redirect('admin/tasks');
        }
    }

    /**
     * It gets a department by its id, if it doesn't exist, it creates a session for fail and returns
     * back, otherwise it returns the view with the department
     * 
     * @param id The id of the department you want to show.
     * 
     * @return The view is being returned.
     */
    public function show($id)
    {
        $getDepartment = $this->repository->get($id);

        if (!$getDepartment) {
            $this->service->createSessionForFail();
            return back();
        }
        return view('admin.tasks.show', compact('getDepartment'));
    }

    /**
     * It gets the department with the id of  and passes it to the view
     * 
     * @param id The id of the department you want to edit.
     * 
     * @return A view with the department information.
     */
    public function edit($id)
    {
        $getDepartment = $this->repository->get($id);

        return view('admin.tasks.input', compact('getDepartment'));
    }

    /**
     * It updates a tasks with the given id
     *
     * @param id The id of the school you want to update.
     * @param Request request The request object.
     *
     * @return the result of the update function in the repository.
     */
    public function update($id, Request $request)
    {
        if ($this->repository->get($id)) {
            $update = $this->repository->update($id, $request);
            if ($update) {
                $this->service->createSessionForSuccess();
                return redirect('admin/tasks');
            }
        }
        $this->service->createSessionForFail();
        return back();
    }

    /**
     * It deletes the record with the given id
     *
     * @param Request request The request object
     * @param id The id of the resource to be deleted.
     *
     * @return The response is being returned.
     */
    public function destroy($id)
    {
        if (!$this->repository->get($id)) {
            $this->service->createSessionForFail();
            return back();
        }
        $this->repository->delete($id);
        $this->service->createSessionForSuccess();
        return redirect('admin/tasks');
    }
}
