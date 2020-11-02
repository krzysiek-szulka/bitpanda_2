<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\RepositoryInterface;

class TransactionService
{
    private RepositoryInterface $transactionRepository;

    public function __construct(RepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @return Transaction[]
     */
    public function getAll(): array
    {
        return $this->transactionRepository->all();
    }
}
