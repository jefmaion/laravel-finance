<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\AccountService;
use App\Services\CategoryService;
use App\Services\TransactionService;
use App\Services\TransactionTypeService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private $serviceTransaction;

    private $serviceCategory;
    private $serviceAccount;
    private $serviceTransactionType;

    public function __construct( TransactionService $serviceTransaction, CategoryService $serviceCategory, AccountService $serviceAccount, TransactionTypeService $transactionType)
    {
        $this->serviceTransaction = $serviceTransaction;
        $this->serviceCategory = $serviceCategory;
        $this->serviceAccount = $serviceAccount;
        $this->serviceTransactionType = $transactionType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($start=null, $end=null)
    {

     


        $data = [
            'transactions' => $this->serviceTransaction->listTransactions($start,$end),
            'resume' => $this->serviceTransaction->getResume(),
            'resumeCategory' => $this->serviceTransaction->getSumByCategory(),
            'range' => $this->serviceTransaction->getListMonths(12, $start)
        ];

        return view('transaction.index', $data);
    }

    public function form($id=0) {


        if($id == 0) {
            return $this->create();
        }

        return $this->edit($id);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [
            'transaction' => new Transaction(),
            'categories'  => $this->serviceCategory->listCategories(),
            'accounts'    => $this->serviceAccount->listAccounts(),
            'types'       => $this->serviceTransactionType->listTransactionTypes()
        ];

        return view('transaction.create', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $this->serviceTransaction->addTransaction($request->except('_token'));
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'transaction' => $this->serviceTransaction->getTransaction($id),
            'categories'  => $this->serviceCategory->listCategories(),
            'accounts'    => $this->serviceAccount->listAccounts(),
            'types'       => $this->serviceTransactionType->listTransactionTypes()
        ];

        return view('transaction.update', $data)->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $this->serviceTransaction->updateTransaction($request->except('_token'), $id);
        return true;
    }

    public function deleteAll(Request $request) {
       
        $this->serviceTransaction->deleteMany($request['transaction']);
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->serviceTransaction->deleteTransaction($id);
        return redirect(route('transaction.index'));
    }


}
