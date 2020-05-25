<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteCreate;
use App\Http\Requests\UserUpdate;
use App\Models\User;
use App\Services\Contracts\NoteContract as NoteServiceContract;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Throwable;
use function GuzzleHttp\json_encode as jsonEncode;

class HomeController extends Controller
{
    /** @var NoteServiceContract */
    private $noteService;
    /** @var AuthManager  */
    private $auth;

    /**
     * HomeController constructor.
     * @param NoteServiceContract $service
     * @param AuthManager $authManager
     */
    public function __construct(NoteServiceContract $service, AuthManager $authManager)
    {
        $this->noteService = $service;
        $this->auth = $authManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $notes = jsonEncode($this->noteService->all($this->auth->guard()->id()));
        $user = jsonEncode($this->auth->guard()->user());
        return view('home', ['notes' => $notes, 'user' => $user]);
    }

    /**
     * Update note
     *
     * @param NoteCreate $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UserUpdate $request)
    {
        /** @var User $user */
        $user = $this->auth->guard()->user();
        $user->fill($request->validated())->saveOrFail();
        return redirect()->route('home');
    }

}
