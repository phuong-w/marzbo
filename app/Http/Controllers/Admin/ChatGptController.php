<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatGpt\AddApiKeyRequest;
use App\Http\Requests\ChatGpt\StoreChatGptRequest;
use App\Models\ChatGpt;
use App\Repositories\ChatGpt\ChatGptRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use OpenAI\Laravel\Facades\OpenAI;

class ChatGptController extends Controller
{
    private $chatGptRepository;
    private $userRepository;

    public function __construct(
        ChatGptRepositoryInterface $chatGptRepository,
        UserRepositoryInterface $userRepository
    ) {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_CHATGPT_MANAGE);

        $this->chatGptRepository = $chatGptRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ChatGpt $chatGpt = null): Response
    {
        $user = auth()->user();

        return Inertia::render('Admin/ChatGpt/Index', [
            'chatGpt' => fn () => $chatGpt ?: null,
            'messages' => $user->chatGpts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|RedirectResponse
    {
        if (auth()->user()->openai_api_key) {
            return to_route('admin.chat_gpt.index');
        }
        return Inertia::render('Admin/ChatGpt/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatGptRequest $request, ChatGpt $chatGpt = null): RedirectResponse
    {
        $chatGpt = $this->chatGptRepository->updateOrCreate($request->validated(), $chatGpt);

        return to_route('admin.chat_gpt.index', $chatGpt->uuid);
    }

    /**
     * Add api key openai of the current account
     */
    public function addApiKey(AddApiKeyRequest $request)
    {
        $this->userRepository->addApiKeyOpenai($request->validated());
        return to_route('admin.chat_gpt.index');
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
    public function destroy(ChatGpt $chatGpt): RedirectResponse
    {
        $this->chatGptRepository->destroy($chatGpt);
        return to_route('admin.chat_gpt.index');
    }
}
