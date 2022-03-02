<?php

namespace App\Repository;

use App\Interfaces\TransactionTypeRepositoryInterface;
use App\Models\TransactionType;


class TransactionTypeRepository extends BaseRepository implements TransactionTypeRepositoryInterface {

    public function __construct(TransactionType $model)
    {
        parent::__construct($model);
    }



}