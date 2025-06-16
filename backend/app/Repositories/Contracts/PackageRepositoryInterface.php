<?php

namespace App\Repositories\Contracts;

use App\DTOs\PackageDto;


interface PackageRepositoryInterface
{
    public function paginate(
        int $perPage   = 15,
        ?string $search = null,
        int $page      = 1
    );

    public function create(PackageDto $dto);

    public function delete(int $id): bool;
}
