<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{DocumentCollection, DocumentResource};
use App\Models\Document;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Метод создает новый документ
     *
     * @param Document $document
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDocument(Document $document): JsonResponse
    {
        $document->id = Str::uuid();
        $document->status = 'draft';

        $document->save();

        return response()->json([
            'document' => new DocumentResource($document)
        ]);
    }

    /**
     * Метод получает документ по id
     *
     * @param string $id
     * @return JsonResponse
     */
    public function getDocumentById(string $id): JsonResponse
    {
        $document = Document::find($id);

        if (!$document) {
            return response()->json([
                'error' => 'Нет такого документа'
            ], 404);
        }

        return response()->json([
            'document' => new DocumentResource($document)
        ]);
    }

    /**
     * Метод редактирует выбранный документ
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function editDocument(Request $request, string $id): JsonResponse
    {
        $document = Document::find($id);

        if (!$document) {
            return response()->json([
                'error' => 'Нет такого документа'
            ], 404);
        }

        if ($document->status === Document::STATUS_PUBLISHED) {
            return response()->json([
                'message' => 'Документ опубликован'
            ], 400);
        }

        $document->payload = json_decode($request->getContent(), true);

        if (!$document->payload) {
            return response()->json([
                'message' => 'Данные не переданны'
            ], 400);
        }

        $document->save();

        return response()->json([
            'document' => $document
        ]);
    }

    /**
     * Метод меняет status на published
     *
     * @param string $id
     * @return JsonResponse
     */
    public function updatePublishedDocument(string $id): JsonResponse
    {
        $document = Document::find($id);

        if ($document->status === Document::STATUS_PUBLISHED) {
            return response()->json([
                'message' => 'Документ опубликован'
            ]);
        }

        $document->status = Document::STATUS_PUBLISHED;

        $document->update();

        return response()->json([
            'document' => new DocumentResource($document)
        ]);
    }

    /**
     * Метод возвращает коллекцию докуметов с показом 1 документа
     *
     * @param Document $document
     * @return DocumentCollection
     */
    public function documentGetAll(Document $document): DocumentCollection
    {
        return new DocumentCollection($document->orderByDesc('created_at')->paginate(1));
    }
}
