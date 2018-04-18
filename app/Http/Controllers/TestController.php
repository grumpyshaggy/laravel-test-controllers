<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\NumberService;

class TestController extends Controller
{
    /**
     * @var NumberService
     */
    protected $numberService;

    /**
     * TestController constructor.
     *
     * @param NumberService $numberService
     */
    public function __construct(NumberService $numberService)
    {
        $this->numberService = $numberService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getNumber(Request $request) : Response
    {
        $result = $this->numberService->getRandomNumber();

        if ($result < 10) {
            return response(['message' => 'The value is lower than 10'], 200);
        } else {
            return response(['message' => 'The value is higher or equal to 10'], 200);
        }
    }
}
