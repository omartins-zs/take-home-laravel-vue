<?php

namespace App\Repositories\Eloquent;

use App\Models\Package;
use App\DTOs\PackageDto;
use App\Repositories\Contracts\PackageRepositoryInterface;

class PackageRepository implements PackageRepositoryInterface
{
    public function paginate(int $perPage = 15, ?string $search = null, int $page = 1)
    {
        $query = Package::with('exams');
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(PackageDto $dto)
    {
        $package = Package::create([
            'name' => $dto->name,
            'observations' => $dto->observations,
        ]);

        $package->exams()->sync($dto->exam_ids);

        return $package->load('exams');
    }

    public function delete(int $id): bool
    {
        $pkg = Package::findOrFail($id);
        return $pkg->delete();
    }
}
