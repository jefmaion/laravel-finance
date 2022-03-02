<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionTypeRequest;
use App\Models\TransactionType;
use App\Services\TransactionTypeService;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{

    private $service;

    public function __construct(TransactionTypeService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionTypes = $this->service->listTransactionTypes();

        return view('transactionType.index', ['transactionTypes' => $transactionTypes]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactionType.create', ['transactionType' => new TransactionType()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionTypeRequest $request)
    {
        $this->service->addTransactionType($request->except('_token'));
        return redirect(route('type.index'));
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
        $transactionType  = $this->service->getTransactionType($id);
        return view('transactionType.update', ['transactionType' => $transactionType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionTypeRequest $request, $id)
    {
        $this->service->updateTransactionType($request->except('_token'), $id);
        return redirect(route('type.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->deleteTransactionType($id);
        return redirect(route('type.index'));

    }
}
