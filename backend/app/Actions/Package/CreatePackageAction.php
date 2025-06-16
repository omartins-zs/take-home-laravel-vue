<?php

namespace App\Actions\Package;

use App\DTOs\PackageDto;
use App\Repositories\Contracts\PackageRepositoryInterface;

class CreatePackageAction
{
    public function __construct(
        private PackageRepositoryInterface $repository
    ) {}

    public function execute(PackageDto $dto)
    {
        return $this->repository->create($dto);
    }
}
