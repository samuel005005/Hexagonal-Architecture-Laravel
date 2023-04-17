<?php
declare(strict_types=1);

namespace Src\User\Infrastructure;

use App\Models\User;
use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Email;
use Src\User\Domain\UserEntity;


final class EloquentUserRepository implements UserRepository
{

    private User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function search(Email $email): UserEntity
    {

        try {
            $row = $this->model->query()->where('name','=','Samuel')->get();
            var_dump($row->value('name'));die;
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());die;
        }

        return new UserEntity($row->getAttribute('email'), $row->getAttribute('password'));
    }
}
