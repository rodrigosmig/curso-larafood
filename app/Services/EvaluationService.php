<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluationService
{
    protected $evaluationRepository;
    protected $orderRepository;

    public function __construct(
        EvaluationRepositoryInterface $evaluationRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createNewEvaluation(string $identifyOrder, array $evaluation)
    {
        $clientId   = $this->getIdClient();        
        $order      = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->createNewEvaluationOrder($order->id, $clientId, $evaluation);
    }

    private function getIdClient(): int
    {
        return auth()->user()->id;
    }
}