<?php

namespace App\Repositories\RepositoryInterfaces;

interface UserRepositoryInterface
{
    public function create( array $data );
    public function getAll();
    public function update( int $userId, array $data );

}
