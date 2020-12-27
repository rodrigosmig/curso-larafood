<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\EvaluationService;
use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluationResource;
use App\Http\Requests\Api\StoreEvaluationOrderRequest;

class EvaluationController extends Controller
{
    protected $evaluationService;
    
    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(StoreEvaluationOrderRequest $request)
    {
        $data = $request->validated();

        $evaluation = $this->evaluationService->createNewEvaluation($request->identify, $data);

        return new EvaluationResource($evaluation);
    }
}
