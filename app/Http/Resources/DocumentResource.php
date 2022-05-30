<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public static $wrap = 'document';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'payload' => $this->when($this->payload ?? null, function () {
                return json_decode($this->payload);
            }, function () {
                return (object) [];
            }),
            'created_at' => $this->created_at->format('Y-m-d h:m:s'),
            'updated_at' => $this->updated_at->format('Y-m-d h:m:s')
        ];
    }
}
