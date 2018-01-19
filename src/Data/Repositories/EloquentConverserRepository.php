<?php

namespace App\Data\Repositories;

use Framework\Converser;

use App\Data\Contracts\ConverserRepositoryInterface;

class EloquentConverserRepository extends Repository implements ConverserRepositoryInterface
{
    public function __construct()
    {
        $this->converser = new Converser;

        parent::__construct($this->converser);
    }

}
