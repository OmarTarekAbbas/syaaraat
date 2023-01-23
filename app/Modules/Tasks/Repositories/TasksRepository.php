<?php

namespace App\Modules\Tasks\Repositories;

use App\Modules\Tasks\{
    Models\Task as Model,
    Resources\TasksResource as Resource,
};

class TasksRepository
{
    /**
     * {@inheritDoc}
     */
    const MODEL = Model::class;

    /**
     * {@inheritDoc}
     */
    const RESOURCE = Resource::class;


    /**
     * It creates a new model with the title from the request
     * 
     * @param request The request object
     * @return The newly created model.
     */
    public function create($request)
    {
        return Model::create([
            'title' => $request->title,
            'status' => $request->status,
            'employee_id' => $request->employee_id,
        ]);
    }

    /**
     * > This function returns a new TasksResource object, which is a collection of the data from the
     * Model::findOrFail() function
     *
     * @param id The id of the school you want to get.
     *
     * @return A new TasksResource object.
     */
    public function get($id)
    {
        try {
            return Model::findOrFail($id);
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * It deletes the data from the database.
     *
     * @param id The id of the model you want to delete.
     */
    public function delete($id)
    {
        Model::destroy($id);
    }

    /**
     * It updates the school name.
     *
     * @param id The id of the school you want to update
     * @param request The request object
     *
     * @return A new TasksResource object.
     */
    public function update($id, $request)
    {
        Model::where('id', $id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'employee_id' => $request->employee_id,
        ]);
        return $this->get($id);
    }

    /**
     * > This function returns all the records in the database
     *
     * @return All the data in the table.
     */
    public function list()
    {
        return Model::all();
    }
}
