<?php

namespace App\Modules\Departments\Services;


use App\Http\Services\Services;
use App\Modules\Departments\Repositories\DepartmentsRepository;
use Illuminate\Support\Facades\Validator;


class DepartmentsService extends Services
{
    /**
     * Main Repository
     *
     * @var DepartmentsRepository
     */
    protected ?DepartmentsRepository $repository;

    /**
     * Constructor

     * @param DepartmentsRepository $repository
     */
    public function __construct(DepartmentsRepository $repository)
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
            'title' =>  'required|max:25|min:2',
        ]);
    }
}
