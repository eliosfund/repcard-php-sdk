<?php

declare(strict_types=1);

namespace RepCard\Concerns;

use Illuminate\Http\Client\Response;
use RepCard\Http\Requests\UserRequest;
use RepCard\RepCardService;

/**
 * @phpstan-require-extends RepCardService
 *
 * @mixin RepCardService
 */
trait Users
{
    public function getUsers(
        ?int $companyId = null,
        int $perPage = 30,
        int $page = 1
    ): Response {
        return $this->get('users/minimal', [
            'company_id' => $companyId ?? $this->companyId,
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }

    public function getUser(int $userId): Response
    {
        return $this->get("users/$userId/details");
    }

    public function getEventUser(int $userId): Response
    {
        return $this->get("event-users/$userId");
    }

    public function createUser(UserRequest $request): Response
    {
        $data = $request->validate($request->rules());

        return $this->post('users', $data);
    }

    public function updateUser(int $userId, UserRequest $request): Response
    {
        $data = $request->validate($request->rules());

        return $this->put("users/$userId", $data);
    }

    public function unlinkUser(int $userId): Response
    {
        return $this->post("users/$userId/unlink", [
            'assignContact' => 1,
        ]);
    }
}
