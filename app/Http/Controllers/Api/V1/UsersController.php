<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

// use App\Http\Requests\Api\V1\User\Store as StoreUserRequest;
use App\Http\Requests\Api\V1\User\Update as UpdateUserRequest;

use Illuminate\Http\JsonResponse;

class UsersController extends ApiController
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Отобразить список сущностей с дополнительной фильтрацией.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::withCount([
                'articles',
                'comments'
            ])
            ->advancedFilter();

        $collection = new UserCollection($users);

        return $collection->response()
            ->setStatusCode(JsonResponse::HTTP_PARTIAL_CONTENT);
    }

    /**
     * Создать и сохранить сущность в хранилище.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        abort(JsonResponse::HTTP_FORBIDDEN);
    }

    /**
     * Отобразить сущность.
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        $resource = new UserResource($user);

        return $resource->response()
            ->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Обновить сущность в хранилище.
     * @param  UpdateUserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only([
            'name',
            'info',
        ]));

        $resource = new UserResource($user);

        return $resource->response()
            ->setStatusCode(JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Удалить сущность из хранилища.
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
