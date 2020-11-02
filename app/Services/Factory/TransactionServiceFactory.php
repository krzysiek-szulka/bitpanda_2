<?php declare(strict_types=1);

namespace App\Services\Factory;

use App\Services\TransactionService;
use Illuminate\Container\Container;
use Infrastructure\Csv\Repository\TransactionRepository as CsvTransactionRepository;
use Infrastructure\Database\Repository\TransactionRepository as DbTransactionRepository;
use InvalidArgumentException;

class TransactionServiceFactory
{
    private const SOURCE_TYPE_DB = 'db';
    private const SOURCE_TYPE_CSV = 'csv';

    private string $sourceType;

    public function __construct(string $sourceType)
    {
        $this->sourceType = $sourceType;
    }

    public function build(): TransactionService
    {
        switch ($this->sourceType) {
            case self::SOURCE_TYPE_CSV:
                return new TransactionService(Container::getInstance()->get(CsvTransactionRepository::class));
            case self::SOURCE_TYPE_DB:
                return new TransactionService(new DbTransactionRepository());
            default:
                throw new InvalidArgumentException('Invalid transaction source type');
        }
    }
}
