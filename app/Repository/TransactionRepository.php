<?php

namespace App\Repository;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface {

    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }


    public function all($start=null, $end=null) : Collection {
        // return Transaction::orderBy('created_at', 'desc')->get();
        return Transaction::whereBetween('trans_date', [$start, $end])->orderBy('executed', 'asc')->orderBy('trans_date', 'desc')->get();
    }

    public function getSumResume() {
        return DB::table('transactions')
                ->select(DB::raw("SUM(amount) AS amount"))
                ->groupBy('amount_type')
                ->whereNull('deleted_at')
                ->where('executed', '=', 1)
                ->get();
    }

    public function getSumByCategory() {
        return DB::table('transactions')
                ->join('categories as b', 'b.id', '=', 'transactions.category_id')
                ->join('categories as c', 'c.id', '=', 'b.category_id')
                ->select(DB::raw(" c.name,  SUM(transactions.amount) AS amount"))
                ->groupBy('c.name')
                ->whereNull('transactions.deleted_at')
                ->where('transactions.executed', '=', 1)
                ->orderByRaw("SUM(transactions.amount) DESC")
                ->get();
    }

}