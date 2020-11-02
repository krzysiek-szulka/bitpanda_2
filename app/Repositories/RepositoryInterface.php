<?php declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get all records
     * @return Model[]
     */
    public function all(): array;
}
