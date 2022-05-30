<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\{JsonResource, ResourceCollection};

class DocumentCollection extends ResourceCollection
{
    private $pagination;

    public static $wrap = 'document';

    public function __construct($resource)
    {
        $this->pagination = [
            'page' => $resource->currentPage(),
            'perPage' => $resource->lastPage(),
            'total' => $resource->total()
        ];

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'document' => $this->collection,
            'pagination' => $this->pagination
        ];
    }

    public function toResponse($request)
    {
        return JsonResource::toResponse($request);
    }
}
