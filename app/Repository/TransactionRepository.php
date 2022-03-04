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
        return Transaction::whereBetween('trans_date', [$start, $end])->orderBy('executed', 'asc')->orderBy('created_at', 'desc')->get();
    }

    public function listDescriptions() {
        return DB::table('transactions')->select('description')->distinct()->get();
    }

    public function listByMonth($month=null, $year=null) {
        // return Transaction::whereMo('MONTH(trans_date)', '=', $month)->where('YEAR(trans_date)', '=', $year)->get();
        return Transaction::whereMonth('trans_date', '=', $month)->whereYear('trans_date', $year)->orderBy('description', 'asc')->get();
    }

    public function getSumResume($start, $end) {
        // return DB::table('transactions')
        //         ->select(DB::raw("SUM(amount) AS amount"))
        //         ->groupBy('amount_type')
        //         ->whereNull('deleted_at')
        //         ->where('executed', '=', 1)
        //         ->get();



        return DB::table('transactions AS a')
            ->selectRaw("
                        sum(CASE WHEN a.amount_type = 1 THEN a.amount ELSE 0 END) AS receitas,
                        sum(CASE WHEN a.amount_type = 2 THEN a.amount ELSE 0 END) AS despesas,
                        sum(CASE WHEN a.amount_type = 1 THEN a.amount ELSE 0 END) - sum(CASE WHEN a.amount_type = 2 THEN a.amount ELSE 0 END) as saldo"
                    )
            ->where('a.executed', '=', 1)
            ->whereBetween('a.trans_date', [$start, $end])
            ->first();
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