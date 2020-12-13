<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }*/

    public function testCreateBoardSuccess()
    {
        $response = $this->postJson('/web/boards/store', [
            'title' => $title = substr(md5(time()), 0, 6),
            'description' => $description = substr(md5(time()), 0, 25),
            'price' => $price = substr(md5(0, 6)),

        ]);

        $response->assertStatus(Response::HTTP_CREATED);
}}
