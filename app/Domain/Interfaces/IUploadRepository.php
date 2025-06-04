<?php

namespace App\Domain\Interfaces;

interface IUploadRepository {

    public function save(array $data);
    public function get_file(string $id);

}


?>
