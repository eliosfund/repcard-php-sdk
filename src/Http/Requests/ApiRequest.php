<?php

declare(strict_types=1);

namespace RepCard\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule as Rule;
use Illuminate\Foundation\Http\FormRequest;

abstract class ApiRequest extends FormRequest
{
    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): static
    {
        /** @phpstan-ignore-next-line */
        return (new static())->replace($data);
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, Rule|array|string>
     */
    abstract public function rules(): array;
}
