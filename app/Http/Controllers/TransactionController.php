<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\GetTransactionListOptions;
use App\Services\Factory\TransactionServiceFactory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Narrowspark\HttpStatus\HttpStatus;

class TransactionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $options = GetTransactionListOptions::fromRequest($request);

        try {
            $transactionService = (new TransactionServiceFactory($options->source))->build();
            $transactions = $transactionService->getAll();

            return new JsonResponse($transactions);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], HttpStatus::STATUS_BAD_REQUEST);
        } catch (Exception $e) {
            echo $e->getMessage();exit;
            return new JsonResponse(['error' => 'Unable to return transactions data'], HttpStatus::STATUS_INTERNAL_SERVER_ERROR);
        }
    }
}
