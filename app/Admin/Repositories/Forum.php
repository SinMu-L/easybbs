<?php

namespace App\Admin\Repositories;

use App\Models\Forum as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Forum extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
