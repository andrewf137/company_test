<?php
declare(strict_types=1);

namespace App\Services\KanyeQuotes;

use Illuminate\Support\Manager;

class KanyeQuotesManager extends Manager
{
    public function createKanyeApiRestDriver(): KanyeApiRestDriver
    {
        $endPoint = $this->config->get('kanye-quotes.kanye-api-rest.endpoint', 'https://api.kanye.rest/');
        $numberOfQuotes = $this->config->get('kanye-quotes.kanye-api-rest.numberOfQuotes', 5);
        return new KanyeApiRestDriver($endPoint, $numberOfQuotes);
    }

    public function getDefaultDriver()
    {
        return $this->config->get('kanye-quotes.driver', 'kanye-api-rest');
    }
}
