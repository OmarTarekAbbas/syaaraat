<?php

namespace App\Modules\Departments\Repositories;

use App\Modules\Departments\{
    Models\Department as Model,
    Resources\DepartmentsResource as Resource,
};

class DepartmentsRepository
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
        ]);
    }

    /**
     * > This function returns a new DepartmentsResource object, which is a collection of the data from the
     * Model::findOrFail() function
     *
     * @param id The id of the school you want to get.
     *
     * @return A new DepartmentsResource object.
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
     * @return A new DepartmentsResource object.
     */
    public function update($id, $request)
    {
        Model::where('id', $id)->update([
            'title' => $request->title,
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
