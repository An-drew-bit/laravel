<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\StatusEnum;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\DocumentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentCollection;

class DocumentController extends Controller
{
    public function __construct(
       private DocumentService $documentService,
    ) {
    }

    /**
     * Метод создает новый документ
     */
    public function createDocument(): JsonResponse
    {
        $document = $this->documentService
            ->createDocument();

        return response()->json([
            'document' => new DocumentResource($document)
        ]);
    }

    /**
     * Метод получает документ по id
     */
    public function getDocumentById(string $id): JsonResponse
    {
        $document = $this->documentService->findByUuid($id);

        if (!$document) {
            return response()->json([
                'error' => 'Нет такого документа'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'document' => new DocumentResource($document)
        ]);
    }

    /**
     * Метод редактирует выбранный документ
     */
    public function editDocument(DocumentRequest $request, string $id): JsonResponse
    {
        $document = $this->documentService->findByUuid($id);

        if (!$document) {
            return response()->json([
                'error' => 'Нет такого документа'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($document->status === StatusEnum::STATUS_PUBLISHED) {
            return response()->json([
                'message' => 'Документ опубликован'
            ], Response::HTTP_BAD_REQUEST);
        }

        $document->payload = json_decode($request->getPayload(), true);

        $document->save();

        return response()->json([
            'document' => $document
        ]);
    }

    /**
     * Метод меняет status на published
     */
    public function updatePublishedDocument(string $id): JsonResponse
    {
        $document = $this->documentService->findByUuid($id);

        if ($document->status === StatusEnum::STATUS_PUBLISHED) {
            return response()->json([
                'message' => 'Документ опубликован'
            ]);
        }

        $document->status = StatusEnum::STATUS_PUBLISHED;

        $document->update();

        return response()->json([
            'document' => new DocumentResource($document)
        ]);
    }

    /**
     * Метод возвращает коллекцию докуметов с показом 1 документа
     */
    public function documentGetAll(): DocumentCollection
    {
        return new DocumentCollection($this->documentService->getAll());
    }
}
