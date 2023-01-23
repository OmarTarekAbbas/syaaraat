<?php

namespace App\Modules\Employees\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Employees\Repositories\EmployeesRepository;
use App\Modules\Departments\Repositories\DepartmentsRepository;
use App\Modules\Employees\Services\EmployeesService;

class EmployeesController extends Controller
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
    public $departmentsRepository;
    /**
     * The constructor function is used to inject the dependencies of the class
     * 
     * @param EmployeesRepository EmployeesRepository This is the repository that will be used to access
     * the database.
     * @param EmployeesService EmployeesService This is the service class that will be used to perform the
     * CRUD operations.
     * @param StoreSchoolRequest storeRequest This is the request class that will be used to validate
     * the data before it is stored in the database.
     * @param UpdateSchoolRequest updateRequest This is the request class that will be used to validate
     * the data before updating the school.
     */
    public function __construct(EmployeesRepository $employeesRepository, EmployeesService $employeesService, DepartmentsRepository $departmentsRepository)
    {
        $this->repository  = $employeesRepository;
        $this->departmentsRepository  = $departmentsRepository;
        $this->service  = $employeesService;
        
    }

    /**
     * It returns a collection of all the Employees in the database
     *
     * @param Request request This is the request object that is sent to the API.
     *
     * @return A collection of all the Employees in the database.
     */
    public function index(Request $request)
    {
        $employees = $this->employees($request);
        return view('admin.employees.list', compact('employees'));
    }

    /**
     * It returns a view called `admin.employees.input`
     * 
     * @return The view 'admin.employees.input'
     */
    public function create(Request $request)
    {
        $departments = $this->departmentsRepository->list();
        return view('admin.employees.input', compact('departments'));
    }


    /**
     * It validates the request, creates a new employee, and redirects to the employees page
     * 
     * @param Request request The request object.
     * 
     * @return The method is returning the view of the employees.
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
            return redirect('admin/employees');
        }
    }

    /**
     * It gets a employee by its id, if it doesn't exist, it creates a session for fail and returns
     * back, otherwise it returns the view with the employee
     * 
     * @param id The id of the employee you want to show.
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
        return view('admin.employees.show', compact('getDepartment'));
    }

    /**
     * It gets the employee with the id of , gets a list of departments, and returns a view with the
     * employee and departments
     * 
     * @param id The id of the employee you want to edit.
     */
    public function edit($id)
    {
        $getEmployee = $this->repository->get($id);
        $departments = $this->departmentsRepository->list();
        return view('admin.employees.input', compact('getEmployee', 'departments'));
    }

    /**
     * It updates a employees with the given id
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
                return redirect('admin/employees');
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
        return redirect('admin/employees');
    }

    /**
     * > This function returns a list of employees or a search result of employees
     * 
     * @param request The request object
     * 
     * @return The employees method is returning the result of the list method in the repository.
     */
    public function employees($request)
    {
        if ($request->search) {
            return $this->repository->search($request);
        } else {
            return $this->repository->list();
        }
    }
}
