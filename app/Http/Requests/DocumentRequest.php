<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payload' => ['required', 'json'],
        ];
    }

    public function getPayload(): string
    {
        return $this->get('payload');
    }

    public function attributes(): array
    {
        return [
            'payload' => 'Данные непереданны',
        ];
    }
}
