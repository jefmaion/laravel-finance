<?php

namespace App\Services;

use App\Repository\TransactionRepository;

class TransactionService {

    private $transactionRepository;

    public function __construct(TransactionRepository $TransactionRepository)
    {
        $this->transactionRepository = $TransactionRepository;
    }

    public function getTransaction(int $id) {
        return $this->transactionRepository->getById($id);
    }

    public function addTransaction(array $request) {
        return $this->transactionRepository->create($request);
    }

    public function updateTransaction(array $request, int $id) {
        return $this->transactionRepository->update($request, $id);
    }

    public function deleteTransaction(int $id) {
        return $this->transactionRepository->destroy($id);
    }

    public function listTransactions() {
        return $this->transactionRepository->all();
    }

    public function getResume() {
        return $this->transactionRepository->getSumResume();
    }
    public function getSumByCategory() {
        return $this->transactionRepository->getSumByCategory();
    }

 
}