<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Document;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\DocumentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

final class DocumentService
{
    public function __construct(
        private DocumentRepository $repository,
    ) {
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->repository->getAll();
    }

    public function createDocument(): Document
    {
        return $this->repository->create();
    }

    public function findByUuid(string $uuid): Model|Document
    {
        return $this->repository->findByUuid($uuid);
    }
}
