<?php

namespace App\Http\Services;

use Illuminate\Http\Response;


class Services
{
    /**
     * It creates a session for success.
     * 
     * @return The session is being returned.
     */
    public function createSessionForSuccess()
    {
        $createSessionForSuccess = request()->session()->flash('success', 'Successfully');
        return $createSessionForSuccess;
    }

    /**
     * This function creates a session for a failed attempt
     * 
     * @return The session is being returned.
     */
    public function createSessionForFail()
    {
        $createSessionForSuccess = request()->session()->flash('notFound', 'Not Found');
        return $createSessionForSuccess;
    }

    public function createSessionForNotDelete()
    {
        $createSessionForSuccess = request()->session()->flash('notFound', 'cannot delete department which has employee assigned to it');
        return $createSessionForSuccess;
    }

   
}
