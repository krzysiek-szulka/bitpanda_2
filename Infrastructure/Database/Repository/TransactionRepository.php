<?php declare(strict_types=1);

namespace Infrastructure\Database\Repository;

use App\Models\Transaction;
use App\Repositories\RepositoryInterface;

class TransactionRepository implements RepositoryInterface
{
    /**
     * @return Transaction[]
     */
    public function all(): array
    {
        return Transaction::all()->toArray();
    }
}
