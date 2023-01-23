<?php

namespace App\Modules\Users\Repositories;

use App\Modules\Users\{
    Models\User as Model,
    Resources\UsersResource as Resource,
};
use App\Modules\Users\Traits\Auth\FindForLogin;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
    use FindForLogin;
    /**
     * {@inheritDoc}
     */
    const MODEL = Model::class;

    /**
     * {@inheritDoc}
     */
    const RESOURCE = Resource::class;

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
     * > This function returns a new UsersResource object, which is a collection of the data from the
     * Model::findOrFail() function
     *
     * @param id The id of the school you want to get.
     *
     * @return A new UsersResource object.
     */
    public function get($id)
    {
        try {
            return new Resource(Model::findOrFail($id));
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * It creates a new user in the database with the given name, email, phone, and password
     * 
     * @param request The request object.
     * 
     * @return A new user is being created and returned.
     */
    public function register($request)
    {
        return Model::create([
            'name' => 'admin',
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);
    }
}
