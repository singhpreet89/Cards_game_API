<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ResultRequest;
use App\Http\Resources\ResultResource;
use App\Http\Resources\ResultCollection;
use App\Services\GamePlayService;
use Symfony\Component\HttpFoundation\Response;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Result::select('user_name', DB::raw('sum(user_score) as hands_won, sum(user_won) as games_won'))->groupBy('user_name')->get();
        
        return ResultCollection::collection($result);
        // return response([
        //     'data' => ResultCollection::collection($result)
        // ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *         \App\Services\GamePlayService  $gamePlayService 
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRequest $request, GamePlayService $gamePlayService)
    {
        $calculatedResult = $gamePlayService->calculateResults($request);

        $result = new Result;
        $result->user_name = $request->user_name;
        $result->user_score = $calculatedResult['userScore'];
        $result->generated_hand_score = $calculatedResult['generatedHandScore'];

        $result->user_won = $calculatedResult['userScore'] !== $calculatedResult['generatedHandScore'] ? ($calculatedResult['userScore'] > $calculatedResult['generatedHandScore'] ? 1 : 0) : 0;
        $result->save();

        // return new ResultResource($result);
        return response([
            'data' => new ResultResource($result)
        ], Response::HTTP_CREATED);
    }
}
