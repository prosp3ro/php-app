<?php

declare(strict_types = 1);

namespace App\Models;

use App\App;
use App\DB;
use Doctrine\DBAL\Query\QueryBuilder;

abstract class Model
{
    protected DB $db;
    protected QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->db = App::db();
        $this->queryBuilder = $this->db->createQueryBuilder();
    }
}
