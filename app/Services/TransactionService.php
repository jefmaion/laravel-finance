<?php

namespace App\Services;

use App\Repository\TransactionRepository;
use DateTime;

class TransactionService {

    private $transactionRepository;

    public function __construct(TransactionRepository $TransactionRepository)
    {
        $this->transactionRepository = $TransactionRepository;
    }

    public function getListMonths($max=12, $select=null) {

        

        $months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        $select = (!$select) ? date('Y-m-d') : $select;

        for($i=$max;$i>=-$max;$i--) {
            $date = date('Y-m-d', strtotime('+' .$i.'months', strtotime(date('Y-m-d'))));

            $d[] = [
                'date' => date('Y-m', strtotime($date)),
                'start' => date('Y-m-01', strtotime($date)),
                'end' => (new DateTime(date('Y-m-01', strtotime($date))))->format( 'Y-m-t' ),
                'label' => $months[(date('n', strtotime($date)))-1].'/'. date('Y', strtotime($date)),
                'select' => (date('m/Y', strtotime($date)) == date('m/Y', strtotime($select))) ? 'selected' : ''
            ];
        }

        return $d;

    }

    public function getTransaction(int $id) {
        return $this->transactionRepository->getById($id);
    }

    public function addTransaction(array $request) {

        

        $create = $this->transactionRepository->create($request);

        if($request['repeat_type']) {
            
            $newDate = $request['trans_date'];
            $repeatTimes = $request['repeat_times'];
            $repeatType = $request['repeat_type'];
            $transactionTypeId = $request['repeat_transaction_type_id'];

            unset($request['repeat_type']);
            unset($request['repeat_times']);
            unset($request['repeat_transaction_type_id']);


            $transactions = [];
            for($i=1;$i<=$repeatTimes; $i++) {

                $newDate = date('Y-m-d', strtotime('+1 '.$repeatType, strtotime($newDate)));

                $request['trans_date'] = $newDate;
                $request['transaction_type_id'] = $transactionTypeId;
                $request['executed'] = 0;

                $request['created_at'] = date('Y-m-d H:i:s');
                $request['updated_at'] = $request['created_at'];

                $transactions[] = $request;
            }

            $this->transactionRepository->createMany($transactions);
        }

        return $create;
    }

    public function updateTransaction(array $request, int $id) {
        return $this->transactionRepository->update($request, $id);
    }

    public function deleteTransaction(int $id) {
        return $this->transactionRepository->destroy($id);
    }

    public function deleteMany($ids) {
        return $this->transactionRepository->destroyMany($ids);
    }

    public function listTransactions($start=null, $end=null) {

        if(!$start) {
            $start = date('Y-m-01');
            $end = (new DateTime($start))->format( 'Y-m-t' );
        }

        return $this->transactionRepository->all($start, $end);
    }

    public function getResume() {
        return $this->transactionRepository->getSumResume();
    }
    public function getSumByCategory() {
        return $this->transactionRepository->getSumByCategory();
    }

 
}