<?php

namespace App\Modules\Departments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    /* Telling Laravel that the table name is students. */
    protected $table = 'departments';

    /* Telling Laravel that the only field that can be filled in the database is the name field. */
    protected $fillable = [
        'title',
    ];

    /**
     * > This function returns all the students that belong to this school
     *
     * @return A collection of students that belong to the school.
     */
    public function employees()
    {
        return $this->hasMany('App\Modules\Employees\Models\Employee', 'department_id', 'id');
    }
}
