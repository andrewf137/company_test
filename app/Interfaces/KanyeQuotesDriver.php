<?php
declare(strict_types=1);

namespace App\Interfaces;

interface KanyeQuotesDriver
{
    public function getQuotes(): array;

    public function refreshQuotes(): array;
}
