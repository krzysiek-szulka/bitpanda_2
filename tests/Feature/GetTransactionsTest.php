<?php

namespace Tests\Feature;

use Narrowspark\HttpStatus\HttpStatus;
use Tests\TestCase;

class GetTransactionsTest extends TestCase
{
    public function testBadRequestReturnedIfMissingSourceParameter()
    {
        $response = $this->get('/api/transaction');

        $response->assertStatus(HttpStatus::STATUS_BAD_REQUEST);
        $response->assertJson([
            'error' => 'Invalid transaction source type',
        ]);
    }

    public function testBadRequestReturnedIfInvalidSourceParameter()
    {
        $response = $this->get('/api/transaction?source=api');

        $response->assertStatus(HttpStatus::STATUS_BAD_REQUEST);
        $response->assertJson([
            'error' => 'Invalid transaction source type',
        ]);
    }

    public function testEndpointReturnsDataFromCsvFile()
    {
        $response = $this->get('/api/transaction?source=csv');

        $response->assertStatus(HttpStatus::STATUS_OK);
        $response->assertJsonStructure([
            [
                'id',
                'code',
                'amount',
                'user_id',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function testEndpointReturnsDataFromDatabase()
    {
        $response = $this->get('/api/transaction?source=db');

        $response->assertStatus(HttpStatus::STATUS_OK);
        $response->assertJsonStructure([
            [
                'id',
                'code',
                'amount',
                'user_id',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
