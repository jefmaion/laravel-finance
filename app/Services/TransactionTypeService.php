<?php

namespace App\Services;

use App\Repository\TransactionTypeRepository;

class TransactionTypeService {

    private $transactionTypeRepository;

    public function __construct(TransactionTypeRepository $transactionTypeRepository)
    {
        $this->transactionTypeRepository = $transactionTypeRepository;
    }

    public function getTransactionType(int $id) {
        return $this->transactionTypeRepository->getById($id);
    }

    public function addTransactionType(array $request) {
        return $this->transactionTypeRepository->create($request);
    }

    public function updateTransactionType(array $request, int $id) {
        return $this->transactionTypeRepository->update($request, $id);
    }

    public function deleteTransactionType(int $id) {
        return $this->transactionTypeRepository->destroy($id);
    }

    public function listTransactionTypes() {
        return $this->transactionTypeRepository->all();
    }

 
}