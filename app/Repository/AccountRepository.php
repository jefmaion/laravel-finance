<?php

namespace App\Repository;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;


class AccountRepository extends BaseRepository implements AccountRepositoryInterface {

    public function __construct(Account $model)
    {
        parent::__construct($model);
    }



}