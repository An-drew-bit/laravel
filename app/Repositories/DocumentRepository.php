<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class DocumentRepository
{
    public function __construct(
        private Document $model,
    ) {
    }

    public function create(): Document|Model
    {
        $newDocument = new Document();

        $newDocument->id = Str::uuid();
        $newDocument->status = 'draft';

        $newDocument->save();

        return $newDocument;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->model
            ->newQuery()
            ->orderByDesc('created_at')
            ->paginate(1);
    }

    public function findByUuid(string $uuid): Document|Model
    {
        return $this->model
            ->newQuery()
            ->where('id', $uuid)
            ->first();
    }
}
