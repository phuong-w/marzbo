<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chatgpt\StoreChatgptRequest;
use App\Models\Chatgpt;
use App\Repositories\Chatgpt\ChatgptRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChatgptController extends Controller
{
    private $chatgptRepository;
    private $userRepository;

    public function __construct(
        ChatgptRepositoryInterface $chatgptRepository,
        UserRepositoryInterface $userRepository
    ) {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_CHATGPT_MANAGE);

        $this->chatgptRepository = $chatgptRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Chatgpt $chatgpt = null): Response
    {
        $user = auth()->user();

        return Inertia::render('Admin/Chatgpt/Index', [
            'chatgpt' => fn () => $chatgpt ?: null,
            'messages' => $user->chatgpts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatgptRequest $request, Chatgpt $chatgpt = null): RedirectResponse
    {
        $chatgpt = $this->chatgptRepository->updateOrCreate($request->validated(), $chatgpt);
        if ($chatgpt) {
            return to_route('admin.chatgpt.index', $chatgpt->uuid);
        }
        return to_route('admin.chatgpt.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chatgpt $chatgpt): RedirectResponse
    {
        $this->chatgptRepository->destroy($chatgpt);
        return to_route('admin.chatgpt.index');
    }
}
