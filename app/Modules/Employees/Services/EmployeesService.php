<?php

namespace App\Modules\Employees\Services;


use App\Http\Services\Services;
use App\Modules\Employees\Repositories\EmployeesRepository;
use Illuminate\Support\Facades\Validator;


class EmployeesService extends Services
{
    /**
     * Main Repository
     *
     * @var EmployeesRepository
     */
    protected ?EmployeesRepository $repository;

    /**
     * Constructor

     * @param EmployeesRepository $repository
     */
    public function __construct(EmployeesRepository $repository)
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
            'firstName' => ['required', 'string', 'min:2', 'max:15'],
            'lastName' =>  ['required', 'string', 'min:2', 'max:15'],
            'salary' =>  'required|not_in:0|numeric',
            'department_id' => ['required', 'exists:departments,id'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
