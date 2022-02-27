<?php

namespace App\Repositories;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class AdminRepository implements RepositoryInterfaces\AdminRepositoryInterface
{

    public function create(array $data)
    {
        $user = User::create( $data );
        return $user;
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function getByRole(string $role)
    {
        $role = Role::where('description', $role)->firstOrFail();
        return User::where('role_id', $role->id)->with('profile')->orderBy('created_at', 'desc')->paginate(20);

    }

    public function getByStatus(string $role, int $perPage = 20, int $page = 1)
    {
        // TODO: Implement getByStatus() method.
    }

    public function getAll(int $perPage = 20, int $page = 1)
    {
        return User::orderBy('created_at', 'desc')->with('profile')->paginate(20);
    }

    public function getById(int $id)
    {
        return User::where('id', $id)->with('profile')->firstorFail();
    }

    public function activateOrDeactivateUser($id)
    {
        $user = User::findOrFail($id);
        $userStatus = $user->isActive;
        if( $userStatus === 0){
            $isActive = 1;
            $message = 'User activated!';

        } else{
            $isActive = 0;
            $message = 'User deactivated!';
            }

        $user->update(['isActive' => $isActive]);

        return $message;
    }
}
