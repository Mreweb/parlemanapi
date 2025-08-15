<?php

namespace App\Application\Services\Utility\Report;
use App\Domain\Interfaces\Utility\Report\IReportRepository;

class ReportService{
    public function __construct(private IReportRepository $repository){}

    public function data_count(array $filters){
        return $this->repository->data_count($filters);
    }
    public function search(array $filters){
        return $this->repository->search($filters);
    }
}
