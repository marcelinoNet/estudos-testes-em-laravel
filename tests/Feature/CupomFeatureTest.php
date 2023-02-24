<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CupomFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_open_cupom_index()
    {
        $response = $this->get('/cupom');

        $response->assertStatus(200);
    }

    public function test_open_cupom_index_contains_empty_table()
    {
        $response = $this->get('/cupom');

        $response->assertStatus(200);
        $response->assertSee(__('No cupoms found!'));
    }
}
