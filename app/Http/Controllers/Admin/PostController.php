<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\Facebook\FacebookGroupResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\SocialMediaResource;
use App\Models\Post;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\SocialMedia\SocialMediaRepository;
use App\Repositories\SocialMedia\SocialMediaRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    private $postRepository;
    private $categoryRepository;
    private $socialMediaRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CategoryRepositoryInterface $categoryRepository,
        SocialMediaRepositoryInterface $socialMediaRepository
    ) {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_POST_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_POST_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_POST_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_POST_DELETE)->only('destroy');

        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->socialMediaRepository = $socialMediaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $posts = $this->postRepository->serverPaginationFilteringFor($request->all());

        return Inertia::render('Admin/Post/Index', [
            'posts' => PostResource::collection($posts)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $categories = $this->categoryRepository->all();
        $socialMedias = auth()->user()->socialMedias;
        $facebookGroups = auth()->user()->facebookGroups;

        return Inertia::render('Admin/Post/Create', [
            'categories' => CategoryResource::collection($categories),
            'socialMedias' => SocialMediaResource::collection($socialMedias),
            'facebookGroups' => $facebookGroups ? FacebookGroupResource::collection($facebookGroups) : ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $this->postRepository->create($request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.post.store'));
        return to_route('admin.post.index');
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
    public function edit(Post $post): Response
    {
        return Inertia::render('Admin/Post/Edit', [
            'post' => new PostResource($post)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->postRepository->update($post, $request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.post.update'));
        return to_route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->postRepository->destroy($post);
        session()->flash(NOTIFICATION_SUCCESS, __('success.post.delete'));
        return back();
    }
}
