<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPublished();
    public function getAll();
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
