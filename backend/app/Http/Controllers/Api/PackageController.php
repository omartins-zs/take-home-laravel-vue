<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Package\CreatePackageAction;
use App\DTOs\PackageDto;
use App\Http\Requests\StorePackageRequest;
use App\Repositories\Contracts\PackageRepositoryInterface;

class PackageController extends Controller
{
    public function __construct(
        private CreatePackageAction $createPackage,
        private PackageRepositoryInterface $repository
    ) {}

    /**
     * Lista pacotes com paginação
     *
     * GET /api/packages
     */
    public function index()
    {
        $packages = $this->repository->paginate();
        return response()->json($packages);
    }

    /**
     * Cria um novo pacote de exames
     *
     * POST /api/packages
     */
    public function store(StorePackageRequest $request)
    {
        try {
            $package = $this->createPackage->execute($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Pacote criado com sucesso.',
                'data' => $package
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao criar o pacote.',
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }
}
