<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\KanyeQuotes\KanyeQuotesManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class KanyeQuotesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(
                app(KanyeQuotesManager::class)
                    ->driver('kanye-api-rest')
                    ->getQuotes()
            );
        } catch (\Exception|\Error $e) {
            return $this->buildErrorMessage($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        try {
            return response()->json(
                app(KanyeQuotesManager::class)
                    ->driver('kanye-api-rest')
                    ->refreshQuotes()
            );
        } catch (\Exception|\Error $e) {
            return $this->buildErrorMessage($e);
        }
    }

    /**
     * @param \Exception|\Error $e
     * @return JsonResponse
     */
    private function buildErrorMessage(\Exception|\Error $e): JsonResponse
    {
        /** @var int $statusCode */
        $statusCode = $this->isValidHttpStatus($e->getCode()) ?: 500;

        return response()->json([
            'error' => \sprintf(
                    'Could not retrieve a Kanye quote through the third party api due to error: %s',
                    $e->getMessage())
        ], $statusCode);
    }

    /**
     * @param int $code
     * @return bool
     */
    private function isValidHttpStatus(int $code) : bool
    {
        return array_key_exists($code, Response::$statusTexts);
    }
}
