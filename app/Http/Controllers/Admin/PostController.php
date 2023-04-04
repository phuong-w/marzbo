<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_POST_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_POST_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_POST_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_POST_DELETE)->only('destroy');

        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->serverPaginationFilteringFor($request->all());
//        if ($request->ajax()) {
//            return PostResource::collection($posts);
//        }
//        return view('admin.post.index', compact('posts'));
        return Inertia::render('Admin/Post/Index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->postRepository->create($request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.post.store'));
        return redirect()->route('admin.post.index');
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
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->postRepository->update($post, $request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.post.update'));
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
