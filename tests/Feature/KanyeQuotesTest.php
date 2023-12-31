<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class KanyeQuotesTest extends TestCase
{
    public function testGetKanyeQuotes(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 123456',
        ])->get('/api/kanye');

        $response->assertStatus(200);
        $response->assertJsonIsArray();
        $response->assertJsonCount(5);
    }

    public function testGetKanyeRefreshQuotes(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 123456',
        ])->get('/api/kanye/refresh');

        $response->assertStatus(200);
        $response->assertJsonIsArray();
        $response->assertJsonCount(5);
    }

    public function testQuotesAreCached(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 123456',
        ])->get('/api/kanye');

        $quotes = $response->getContent();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer 123456',
        ])->get('/api/kanye');

        $freshQuotes = $response->getContent();

        $this->assertEquals($quotes, $freshQuotes);
    }

    public function testFreshQuotesAreNewQuotes(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 123456',
        ])->get('/api/kanye');

        $quotes = $response->getContent();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer 123456',
        ])->get('/api/kanye/refresh');

        $freshQuotes = $response->getContent();

        $this->assertNotEquals($quotes, $freshQuotes);
    }

    public function testInvalidEndpoint(): void
    {
        $response = $this->get('whatever');

        $response->assertStatus(404);
        $response->assertContent('{"error":"Endpoint Not Found. Only \'\/api\/kanye\' and \'\/api\/kanye\/refresh\' are available endpoints."}');
    }

    public function testInvalidApiEndpoint(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 123456',
        ])->get('/api/whatever');

        $response->assertStatus(404);
        $response->assertContent('{"error":"Endpoint Not Found. Only \'\/api\/kanye\' and \'\/api\/kanye\/refresh\' are available endpoints."}');
    }

    public function testErrorDueToMissingToken(): void
    {
        $response = $this->get('/api/kanye');

        $response->assertStatus(401);
        $response->assertContent('{"error":"Error while decoding token: The token could not be parsed from the request"}');
    }

    public function testErrorDueToInvalidToken(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ABCDEF',
        ])->get('/api/kanye');

        $response->assertStatus(401);
        $response->assertContent('{"error":"Error while decoding token: Invalid token"}');
    }
}
