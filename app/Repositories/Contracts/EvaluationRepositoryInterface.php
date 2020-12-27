<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function createNewEvaluationOrder(int $IdOrder, int $idClient, array $evaluation);
    public function getEvaluationsByOrder(int $IdOrder);
    public function getEvaluationsByClient(int $idClient);
    public function getEvaluationsById(int $id);
    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient);
}