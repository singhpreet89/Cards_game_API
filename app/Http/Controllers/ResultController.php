<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ControllerTraits\ResultControllerTrait;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ResultRequest;
use App\Http\Resources\ResultResource;
use App\Http\Resources\ResultCollection;
use Symfony\Component\HttpFoundation\Response;

class ResultController extends Controller
{
    use ResultControllerTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::select(
            'SELECT q1.user_name, q2.hands_won, q1.games_won from 
                (SELECT user_name, count(*) as games_won from `results` where user_won = :userWon group by user_name) as q1
                    LEFT JOIN 
                (select user_name, sum(user_score) as hands_won from `results` group by user_name) as q2
            on q1.user_name = q2.user_name',
            ["userWon" => 1]
        );

        return ResultCollection::collection($result);
        // return response([
        //     'data' => ResultCollection::collection($result)
        // ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRequest $request)
    {
        $calculatedResult = $this->calculateResults($request);

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
