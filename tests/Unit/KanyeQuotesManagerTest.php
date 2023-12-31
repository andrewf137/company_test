<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Services\KanyeQuotes\KanyeApiRestDriver;
use App\Services\KanyeQuotes\KanyeQuotesManager;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class KanyeQuotesManagerTest extends TestCase
{
    use CreatesApplication;

    public function testGetKayneApiRestDriverOk(): void
    {
        $kanyeApiRestDriver = app(KanyeQuotesManager::class)->driver('kanye-api-rest');
        $this->assertInstanceOf(KanyeApiRestDriver::class, $kanyeApiRestDriver);
    }

    public function testGetDefaultDriverOk(): void
    {
        $kanyeApiRestDriver = app(KanyeQuotesManager::class)->driver();
        $this->assertInstanceOf(KanyeApiRestDriver::class, $kanyeApiRestDriver);
    }
}
