<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Model;

class Test extends Model
{
    public function selectQueryTest()
    {
        return $this->queryBuilder->select("*")->from("test")->fetchAllAssociative();
    }
}
