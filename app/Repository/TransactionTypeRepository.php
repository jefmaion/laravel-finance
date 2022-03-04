<?php

namespace App\Repository;

use App\Interfaces\TransactionTypeRepositoryInterface;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Collection;

class TransactionTypeRepository extends BaseRepository implements TransactionTypeRepositoryInterface {

    public function __construct(TransactionType $model)
    {
        parent::__construct($model);
    }

    public function all() : Collection {
        return TransactionType::orderBy('name', 'asc')->get();
    }

}