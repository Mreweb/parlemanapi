<?php
use App\Infrastructure\Persistence\Repositories\Common\Country\CityRepository;

beforeEach(function () {
    $this->repository = new CityRepository();
});

it('creates and lists cities with filters', function () {
    $filters = ['province_id' => 8];
    $result = $this->repository->list($filters);
    expect($result['count'])->toBe(1);
    expect($result['list']->first()->city_name)->toBe('Tehran');
});
