<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteCreate;
use App\Http\Resources\Note as NoteResource;
use App\Http\Resources\Notes;
use App\Services\Contracts\NoteContract as NoteServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class NoteController extends Controller
{
    /** @var NoteServiceContract */
    private $service;

    /**
     * NoteController constructor.
     * @param NoteServiceContract $service
     */
    public function __construct(NoteServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function index(int $userId)
    {
        $notes = $this->service->all($userId);
        return JsonResponse::create(Notes::make(NoteResource::make($notes)), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NoteCreate $request
     * @param int $userId
     * @return JsonResponse
     */
    public function store(NoteCreate $request, int $userId)
    {
        $note = $this->service->create($request->validated(), $userId);
        return JsonResponse::create(NoteResource::make($note), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $userId
     * @param int $noteId
     * @return JsonResponse
     */
    public function show(int $userId, int $noteId)
    {
        $note = $this->service->find($userId, $noteId);
        return JsonResponse::create(NoteResource::make($note), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NoteCreate $request
     * @param int $userId
     * @param int $noteId
     * @return JsonResponse
     */
    public function update(NoteCreate $request, int $userId, int $noteId)
    {
        try {
            $data = ['success' => false];
            if ($success = $this->service->update($request->validated(), $userId, $noteId)) {
                $data['success'] = $success;
                $data['message'] = __('message');
            } else {
                $data['message'] = __('second message');
            }
        } catch (Throwable $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = $e->getCode();
        }
        return JsonResponse::create($data, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $userId
     * @param int $noteId
     * @return JsonResponse
     */
    public function destroy(int $userId, int $noteId)
    {
        try {
            $data = ['success' => false];
            if ($success = $this->service->delete($userId, $noteId)) {
                $data['success'] = $success;
                $data['message'] = __('message');
            } else {
                $data['message'] = __('second message');
            }
        } catch (Throwable $e) {
            $data['message'] = $e->getMessage();
            $data['code'] = $e->getCode();
        }
        return JsonResponse::create($data, Response::HTTP_OK);
    }
}
