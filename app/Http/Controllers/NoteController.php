<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteCreate;
use App\Http\Requests\NoteStatusCheck;
use App\Services\Contracts\NoteContract as NoteServiceContract;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{
    /** @var NoteServiceContract */
    private $service;
    /** @var AuthManager */
    private $auth;

    /**
     * HomeController constructor.
     * @param NoteServiceContract $service
     * @param AuthManager $authManager
     */
    public function __construct(NoteServiceContract $service, AuthManager $authManager)
    {
        $this->service = $service;
        $this->auth = $authManager;
    }

    /**
     * Create new note
     *
     * @param NoteCreate $request
     * @return RedirectResponse
     */
    public function store(NoteCreate $request)
    {
        $this->service->create($request->validated(), $this->auth->guard()->id());
        return redirect()->route('home');
    }

    /**
     * Update note
     *
     * @param NoteCreate $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(NoteCreate $request, int $id)
    {
        $this->service->update($request->validated(), $this->auth->guard()->id(), $id);
        return redirect()->route('home');
    }

    /**
     * @param NoteStatusCheck $request
     * @param int $id
     * @return RedirectResponse
     */
    public function status(NoteStatusCheck $request, int $id)
    {
        $this->service->update($request->validated(), $this->auth->guard()->id(), $id);
        return redirect()->route('home');
    }

    /**
     * Delete note
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destruct(int $id)
    {
        $this->service->delete($this->auth->guard()->id(), $id);
        return redirect()->route('home');
    }
}
