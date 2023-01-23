<?php

namespace App\Modules\Employees\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    /* Telling Laravel that the table name is students. */
    protected $table = 'employees';

    /* Telling Laravel that the only field that can be filled in the database is the name field. */
    protected $fillable = [
        'firstName', 'lastName', 'salary', 'department_id', 'image'
    ];

    
    /**
     * The `departments()` function returns the department that the user belongs to
     * 
     * @return The department that the user belongs to.
     */
    public function departments()
    {
        return $this->belongsTo('App\Modules\Departments\Models\Department', 'department_id', 'id');
    }

     /**
     * > This function returns all the students that belong to this school
     *
     * @return A collection of students that belong to the school.
     */
    public function task()
    {
        return $this->hasMany('App\Modules\Tasks\Models\Task', 'employee_id', 'id');
    }
}
