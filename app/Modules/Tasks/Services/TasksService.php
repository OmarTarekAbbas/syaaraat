<?php

namespace App\Modules\Tasks\Services;


use App\Http\Services\Services;
use App\Modules\Tasks\Repositories\TasksRepository;
use Illuminate\Support\Facades\Validator;


class TasksService extends Services
{
    /**
     * Main Repository
     *
     * @var TasksRepository
     */
    protected ?TasksRepository $repository;

    /**
     * Constructor

     * @param TasksRepository $repository
     */
    public function __construct(TasksRepository $repository)
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
            'status' => ['required', 'boolean'],
            'employee_id' => ['required', 'exists:employees,id'],
        ]);
    }
}
