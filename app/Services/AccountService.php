<?php

namespace App\Services;

use App\Repository\AccountRepository;

class AccountService {

    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function getAccount(int $id) {
        return $this->accountRepository->getById($id);
    }

    public function addAccount(array $request) {
        return $this->accountRepository->create($request);
    }

    public function updateAccount(array $request, int $id) {
        return $this->accountRepository->update($request, $id);
    }

    public function deleteAccount(int $id) {
        return $this->accountRepository->destroy($id);
    }

    public function listAccounts() {
        return $this->accountRepository->all();
    }

 
}