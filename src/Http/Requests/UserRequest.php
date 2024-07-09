<?php

declare(strict_types=1);

namespace RepCard\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @property-read string $firstName
 * @property-read string $lastName
 * @property-read string $userEmail
 * @property-read string $phoneNumber
 * @property-read string $jobTitle
 * @property-read string $roleName
 * @property-read string $officeName
 * @property-read string $teamName
 * @property-read string $countryCode
 * @property-read string|null $externalId
 */
class UserRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'userEmail' => ['required', 'email'],
            'phoneNumber' => ['required', 'string'],
            'jobTitle' => ['required', 'string'],
            'roleName' => ['required', Rule::in(config('repcard.roles'))],
            'officeName' => ['required', 'string'],
            'teamName' => ['required', 'string'],
            'countryCode' => ['required', 'string', 'min:2'],
            'externalId' => ['nullable', 'string'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'phoneNumber' => preg_replace('/\d/', '', $this->phoneNumber),
            'countryCode' => Str::start($this->countryCode, '+'),
        ]);
    }
}
