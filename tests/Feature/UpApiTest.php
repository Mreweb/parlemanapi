<?php

namespace Tests\Feature;
use Tests\TestCase;
class UpApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample(){
        $response = $this->get('/up');
        $response->assertStatus(200);
    }
}
