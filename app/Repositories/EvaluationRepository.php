<?php

namespace App\Repositories;

use App\Models\Evaluation;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    protected $entity;

    public function __construct(Evaluation $order)
    {
        $this->entity = $order;
    }

    public function createNewEvaluationOrder(int $idOrder, int $idClient, array $evaluation)
    {
        $data = [
            'client_id' => $idClient,
            'order_id'  => $idOrder,
            'stars'     => $evaluation['stars'],
            'comment'   => isset($evaluation['comment']) ? $evaluation['comment'] : ''
        ];

        return $this->entity->create($data);
    }

    public function getEvaluationsByOrder(int $idOrder)
    {
        return $this->entity
                    ->where('order_id', $idOrder)
                    ->get();
    }

    public function getEvaluationsByClient(int $idClient)
    {
        return $this->entity
                    ->where('client_id', $idClient)
                    ->get();
    }

    public function getEvaluationsById(int $idClient)
    {
        return $this->entity->find($idClient);
    }

    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient)
    {
        return $this->entity
                    ->where('client_id', $idClient)
                    ->where('order_id', $idOrder)
                    ->first();
    }
}