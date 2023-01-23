<?php

namespace App\Modules\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    /* Telling Laravel that the table name is students. */
    protected $table = 'tasks';

    /* Telling Laravel that the only field that can be filled in the database is the name field. */
    protected $fillable = [
        'title',
        'status',
        'employee_id',
    ];

    /**
     * The `employees()` function returns the department that the user belongs to
     * 
     * @return The department that the user belongs to.
     */
    public function employees()
    {
        return $this->belongsTo('App\Modules\Employees\Models\Employee', 'employee_id', 'id');
    }
}
