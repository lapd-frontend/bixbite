<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Note;
use App\Http\Resources\NoteResource;
use App\Http\Resources\NoteCollection;

use App\Http\Requests\Api\V1\Note\Store as StoreNoteRequest;
use App\Http\Requests\Api\V1\Note\Update as UpdateNoteRequest;

use Illuminate\Http\JsonResponse;

class NotesController extends ApiController
{
    protected $advancedAbilityMap = [
        'form' => 'create',
    ];

    protected $advancedMethodsWithoutModels = [
        'form',
    ];

    public function __construct()
    {
        $this->authorizeResource(Note::class, 'note');
    }

    /**
     * Отобразить весь список сущностей,
     * включая связанные сущности.
     * @return JsonResponse
     */
    public function index()
    {
        $notes = Note::with([
                'files',
                'user:users.id,users.name',
            ])
            ->where('user_id', auth('api')->user()->id)
            ->get();

        $collection = new NoteCollection($notes);

        return $collection->response()
            ->setStatusCode(JsonResponse::HTTP_PARTIAL_CONTENT);
    }

    /**
     * Отобразить форму для создания сущности.
     * Позволяет передавать мета-данные и
     * связи с другими сущностями.
     * @param  Note  $note
     * @return JsonResponse
     */
    public function form()
    {
        $note = new Note();
        $note->user = auth('api')->user();
        $note->user_id = $note->user->id;

        $resource = new NoteResource($note);

        return $resource->response()
            ->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Создать и сохранить сущность в хранилище.
     * @param  StoreNoteRequest  $request
     * @return JsonResponse
     */
    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->all());

        $resource = new NoteResource($note);

        return $resource->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Отобразить сущность.
     * @param  Note  $note
     * @return JsonResponse
     */
    public function show(Note $note)
    {
        $note->load([
            'files',
            'user',
        ]);

        $resource = new NoteResource($note);

        return $resource->response()
            ->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Обновить сущность в хранилище.
     * @param  UpdateNoteRequest  $request
     * @param  Note  $note
     * @return JsonResponse
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update($request->all());

        $note->load([
            // 'files',
            // 'user',
        ]);

        $resource = new NoteResource($note);

        return $resource->response()
            ->setStatusCode(JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Удалить сущность из хранилища.
     * @param  Note  $note
     * @return JsonResponse
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
