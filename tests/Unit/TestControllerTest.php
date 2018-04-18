<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\NumberService;
use App\Http\Controllers\TestController;

class TestControllerTest extends TestCase
{
    /**
     * @var \Mockery\Mock|NumberService
     */
    protected $mockNumberService;

    /**
     * Test initialisation.
     */
    public function setUp()
    {
        parent::setUp();

        $this->mockNumberService = Mockery::mock(NumberService::class);
    }

    /**
     * Actions to perform after each test.
     */
    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    /**
     * Test getting a number lower than 10.
     *
     * @return void
     */
    public function testShowNumberLowerThanTen()
    {
        $this->mockNumberService->shouldReceive('getRandomNumber')->andReturn(5);

        $testController = new TestController($this->mockNumberService);

        $response = $testController->getNumber(new Request());

        $this->assertInstanceOf(Response::class, $response);
        $this->assertJson($response->content());
        $this->assertJsonStringEqualsJsonString($response->content(), json_encode(['message' => 'The value is lower than 10']));
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test getting a number higher or equal to 10.
     *
     * @return void
     */
    public function testShowNumberHigherThanTen()
    {
        $this->mockNumberService->shouldReceive('getRandomNumber')->andReturn(15);

        $testController = new TestController($this->mockNumberService);

        $response = $testController->getNumber(new Request());

        $this->assertInstanceOf(Response::class, $response);
        $this->assertJson($response->content());
        $this->assertJsonStringEqualsJsonString($response->content(), json_encode(['message' => 'The value is higher or equal to 10']));
        $this->assertEquals(200, $response->status());
    }
}
