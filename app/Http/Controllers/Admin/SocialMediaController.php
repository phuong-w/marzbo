<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMedia\StoreSocialMediaRequest;
use App\Http\Requests\SocialMedia\UpdateSocialMediaRequest;
use App\Http\Resources\SocialMediaResource;
use App\Models\SocialMedia;
use App\Repositories\SocialMedia\SocialMediaRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SocialMediaController extends Controller
{
    private $socialMediaRepository;

    public function __construct(SocialMediaRepositoryInterface $socialMediaRepository)
    {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_DELETE)->only('destroy');

        $this->socialMediaRepository = $socialMediaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $socialMedias = $this->socialMediaRepository->serverPaginationFilteringFor($request->all());

        return Inertia::render('Admin/SocialMedia/Index', [
            'socialMedias' => SocialMediaResource::collection($socialMedias)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.social_media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaRequest $request)
    {
        $this->socialMediaRepository->create($request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.social_media.store'));
        return redirect()->route('admin.social_media.index');
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
     * @param SocialMedia $socialMedia
     * @return Application|Factory|View
     */
    public function edit(SocialMedia $socialMedia)
    {
        return view('admin.social_media.edit', compact('socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSocialMediaRequest $request
     * @param SocialMedia $socialMedia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSocialMediaRequest $request, SocialMedia $socialMedia)
    {
        $this->socialMediaRepository->update($socialMedia, $request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.social_media.update'));
        return redirect()->route('admin.social_media.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
