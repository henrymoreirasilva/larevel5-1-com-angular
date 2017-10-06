<?php
namespace CodeProject\Repositories;

class ClientRepositoryEloquent extends \Prettus\Repository\Eloquent\BaseRepository implements ClientRepository {
    public function model() {
        return \CodeProject\Entities\Client::class;
    }
}
