<?php

namespace App\Http\Controllers;

use App\Models\UserTrend;
use Illuminate\Http\Request;

class UserTrendsController extends Controller
{
    /**
     * @var UserTrend
     */
    private $userTrend;

    /**
     * UserTrendsController constructor.
     */
    public function __construct(UserTrend $userTrend)
    {
        $this->userTrend = $userTrend;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $trends = $this->userTrend->all()->take(20);
        return response()->json($trends, 200);
    }
}
