<?php

namespace App\Modules\Employees\Repositories;

use App\Modules\Employees\{
    Models\Employee as Model,
    Resources\EmployeesResource as Resource,
};
use Exception;
use Illuminate\Database\Eloquent\Builder;

class EmployeesRepository
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
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'salary' => $request->salary,
            'department_id' => $request->department_id,
            'image' => $this->upload($request),
        ]);
    }

    /**
     * > This function returns a new EmployeesResource object, which is a collection of the data from the
     * Model::findOrFail() function
     *
     * @param id The id of the school you want to get.
     *
     * @return A new EmployeesResource object.
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
     * @return A new EmployeesResource object.
     */
    public function update($id, $request)
    {
        $employee = $this->get($id);
        Model::where('id', $id)->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'salary' => $request->salary,
            'department_id' => $request->department_id,
            'image' => $this->upload($request) ?? $employee->image,
        ]);
        return $employee;
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

   /**
    * It takes a request object, and returns a collection of models that match the search criteria
    * 
    * @param request The request object
    * 
    * @return A collection of models that match the search criteria.
    */
    public function search($request)
    {
        return Model::where(function (Builder $query) use ($request) {
            $query->orWhere('firstName', 'like', "%{$request->search}%");
            $query->orWhere('lastName', 'like', "%{$request->search}%");
            $query->orWhere('salary', 'like', "%{$request->search}%");
        })->get();
    }

    /**
     * It takes a file from a form, saves it to a folder, and returns the path to the file
     * 
     * @param request The request object.
     * 
     * @return The image path is being returned.
     */
    public function upload($request)
    {
        $relUrl = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/upload/employee/';
            $picture = time() . '.' . $extension;
            $destinationPath = public_path() . $folderName;
            $request->file('image')->move($destinationPath, $picture);
            $img_url = $picture;
            $image_path = public_path() . "/upload/employee/" . $relUrl;
            if (file_exists($image_path) && $relUrl != "") {
                try {
                    unlink($image_path);
                } catch (Exception $e) {
                }
            }
            return $img_url;
        }
    }

    /**
     * It returns a query builder object that will return all employees that belong to a specific
     * department
     * 
     * @param id The id of the department
     * 
     * @return A query builder object.
     */
    public function getEmployeeByDepartments($id)
    {
        return Model::where('department_id', $id);
    }

    /**
     * It counts the number of employees in a department.
     * 
     * @param id The id of the department
     */
    public function countEmployeeByDepartments($id)
    {
        $getEmployeeByDepartments =  $this->getEmployeeByDepartments($id);
        return  $getEmployeeByDepartments->count();
    }

    /**
     * It returns the sum of the salary of all employees in a department
     * 
     * @param id The id of the department
     */
    public function searchSalaryEmployeeByDepartments($id)
    {
        $getEmployeeByDepartments =  $this->getEmployeeByDepartments($id);
        return  $getEmployeeByDepartments->sum('salary');
    }
}
