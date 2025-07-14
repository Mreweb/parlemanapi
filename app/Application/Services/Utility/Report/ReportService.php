<?php

namespace App\Application\Services;

use App\Infrastructure\Persistence\Repositories\Report\ReportRepository;

class ReportService{
    public function __construct(private ReportRepository $repository){}

    public function data_count(array $filters){
        return $this->repository->data_count($filters);
    }
    public function search(array $filters){
        return $this->repository->search($filters);
    }
}
