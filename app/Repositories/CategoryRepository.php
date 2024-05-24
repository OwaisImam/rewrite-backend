<?php
namespace App\Repositories;

use App\Models\Categories;
use App\Models\User;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{

    public function model()
    {
        return Categories::class;
    }
}