<?php declare(strict_types=1);

namespace App\Http\Requests\Transaction;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class GetTransactionListOptions extends DataTransferObject
{
    public string $source;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'source' => $request->input('source', ''),
        ]);
    }
}
