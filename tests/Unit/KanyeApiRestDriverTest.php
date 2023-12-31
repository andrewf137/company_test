<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Services\KanyeQuotes\KanyeApiRestDriver;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class KanyeApiRestDriverTest extends TestCase
{
    use CreatesApplication;

    public function testGetQuotesOk(): void
    {
        $KanyeApiRestDriverClass = new KanyeApiRestDriver('https://api.kanye.rest/', 5);
        $quotes = $KanyeApiRestDriverClass->getQuotes();
        $this->assertIsArray($quotes);
        $this->assertCount(5, $quotes);
    }

    public function testRefreshQuotesOk(): void
    {
        $KanyeApiRestDriverClass = new KanyeApiRestDriver('https://api.kanye.rest/', 5);
        $refreshQuotes = $KanyeApiRestDriverClass->refreshQuotes();
        $this->assertIsArray($refreshQuotes);
        $this->assertCount(5, $refreshQuotes);
    }
}
