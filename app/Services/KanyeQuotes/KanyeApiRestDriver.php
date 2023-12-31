<?php
declare(strict_types=1);

namespace App\Services\KanyeQuotes;

use App\Interfaces\KanyeQuotesDriver;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class KanyeApiRestDriver implements KanyeQuotesDriver
{
    private string $endPoint;
    private int $numberOfQuotes;
    private const KANYE_QUOTES_CACHE_KEY = 'kanye_quotes';

    public function __construct(string $endPoint, int $numberOfQuotes)
    {
        $this->endPoint = $endPoint;
        $this->numberOfQuotes = $numberOfQuotes;
    }

    public function getQuotes(): array
    {
        if ($quotes = Cache::get(self::KANYE_QUOTES_CACHE_KEY)) {
            return $quotes;
        }

        return Cache::rememberForever(self::KANYE_QUOTES_CACHE_KEY, function () {
            $quotes = [];
            for ($i = 0; $i < $this->numberOfQuotes; $i++) {
                $quotes[] = $this->getKanyeQuote();
            }

            return $quotes;
        });
    }

    public function refreshQuotes(): array
    {
        Cache::forget(self::KANYE_QUOTES_CACHE_KEY);
        return $this->getQuotes();
    }

    /**
     * @return string
     * @throws \JsonException
     */
    private function getKanyeQuote(): string
    {
        $response = Http::get($this->endPoint);

        return json_decode(
            $response->body(),
            false,
            512,
            JSON_THROW_ON_ERROR
        )->quote;
    }
}
