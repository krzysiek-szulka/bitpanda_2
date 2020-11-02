<?php declare(strict_types=1);

namespace Infrastructure\Csv\Repository;

use App\Models\Transaction;
use App\Repositories\RepositoryInterface;
use League\Csv\Reader;

class TransactionRepository implements RepositoryInterface
{
    private const TRANSACTIONS_FILENAME = 'transactions.csv';
    private string $sourceFileLocation;

    public function __construct(string $sourceFileLocation)
    {
        $this->sourceFileLocation = $sourceFileLocation;
    }

    /**
     * @return array
     * @throws \League\Csv\Exception
     */
    public function all(): array
    {
        $csv = Reader::createFromPath($this->getFilePath(), 'r');
        $csv->setHeaderOffset(0);

        $transactions = [];
        $records = $csv->getRecords();
        foreach ($records as $record) {
            $transaction = new Transaction([
                'code' => $record['code'],
                'amount' => $record['amount'],
                'user_id' => $record['user_id'],
            ]);
            $transaction->id = $record['id'];
            $transaction->created_at = $record['created_at'];
            $transaction->updated_at = $record['updated_at'];

            $transactions[] = $transaction;
        }

        return $transactions;
    }

    private function getFilePath(): string
    {
        return implode('/', [base_path(), $this->sourceFileLocation, self::TRANSACTIONS_FILENAME]);
    }
}
