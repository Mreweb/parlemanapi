<?php

namespace App\Domain\Interfaces\Utility\Report;

interface IReportRepository {
    public function search(array $filters);
    public function data_count(array $filters);
}


?>
