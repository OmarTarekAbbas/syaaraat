<?php

namespace App\Modules\Departments\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Departments\Repositories\DepartmentsRepository;
use App\Modules\Employees\Repositories\EmployeesRepository;
use App\Modules\Departments\Requests\StoreDepartmentsRequest;
use App\Modules\Departments\Requests\UpdateDepartmentsRequest;
use App\Modules\Departments\Services\DepartmentsService;

class DepartmentsController extends Controller
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
     * @param DepartmentsRepository DepartmentsRepository This is the repository that will be used to access
     * the database.
     * @param DepartmentsService DepartmentsService This is the service class that will be used to perform the
     * CRUD operations.
     * @param StoreSchoolRequest storeRequest This is the request class that will be used to validate
     * the data before it is stored in the database.
     * @param UpdateSchoolRequest updateRequest This is the request class that will be used to validate
     * the data before updating the school.
     */
    public function __construct(DepartmentsRepository $departmentsRepository, DepartmentsService $departmentsService, StoreDepartmentsRequest $storeDepartmentsRequest, UpdateDepartmentsRequest $updateDepartmentsRequest, EmployeesRepository $employeesRepository)
    {
        $this->repository  = $departmentsRepository;
        $this->employeesRepository  = $employeesRepository;
        $this->service  = $departmentsService;
        $this->storeRequest  = $storeDepartmentsRequest;
        $this->updateRequest  = $updateDepartmentsRequest;
        
    }

    /**
     * It returns a collection of all the Departments in the database
     *
     * @param Request request This is the request object that is sent to the API.
     *
     * @return A collection of all the Departments in the database.
     */
    public function index(Request $request)
    {
        $departments = $this->repository->list();
        return view('admin.departments.list', compact('departments'));
    }

    /**
     * It returns a view called `admin.departments.input`
     * 
     * @return The view 'admin.departments.input'
     */
    public function create(Request $request)
    {
        return view('admin.departments.input');
    }

    /**
     * It validates the request, creates a new department, and redirects to the departments page
     * 
     * @param Request request The request object.
     * 
     * @return The method is returning the view of the departments.
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
            return redirect('admin/departments');
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
        return view('admin.departments.show', compact('getDepartment'));
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

        return view('admin.departments.input', compact('getDepartment'));
    }

    /**
     * It updates a departments with the given id
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
                return redirect('admin/departments');
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
        // Todo:: edit check by finish task ....
        if ($this->employeesRepository->countEmployeeByDepartments($id)) {
            $this->service->createSessionForNotDelete();
            return back();
        }
        if (!$this->repository->get($id)) {
            $this->service->createSessionForFail();
            return back();
        }
        $this->repository->delete($id);
        $this->service->createSessionForSuccess();
        return redirect('admin/departments');
    }

    /**
     * It gets the department, counts the employees in the department, and then searches for the salary
     * of the employees in the department
     * 
     * @param id The id of the department
     */
    public function search($id)
    {
        $department = $this->repository->get($id);
        $countEmployeeByDepartments = $this->employeesRepository->countEmployeeByDepartments($id);
        $searchSalaryEmployeeByDepartments = $this->employeesRepository->searchSalaryEmployeeByDepartments($id);
        return view('admin.departments.search', compact(
            'department',
            'countEmployeeByDepartments',
            'searchSalaryEmployeeByDepartments'
        ));
    }
}
