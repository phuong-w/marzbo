<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaCredential\StoreSocialMediaCredentialRequest;
use App\Http\Requests\SocialMediaCredential\UpdateSocialMediaCredentialRequest;
use App\Http\Resources\SocialMediaCredential\SocialMediaCredentialResource;
use App\Models\SocialMediaCredential;
use App\Repositories\SocialMediaCredential\SocialMediaCredentialRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SocialMediaCredentialController extends Controller
{
    private $socialMediaCredentialRepository;

    public function __construct(SocialMediaCredentialRepositoryInterface $socialMediaCredentialRepository)
    {
        // Permissions validations
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_DELETE)->only('destroy');

        $this->socialMediaCredentialRepository = $socialMediaCredentialRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $socialMediaCredentials = $this->socialMediaCredentialRepository->serverPaginationFilteringFor($request->all());
        if ($request->ajax()) {
            return SocialMediaCredentialResource::collection($socialMediaCredentials);
        }
        return view('admin.social_media_credential.index', compact('socialMediaCredentials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.social_media_credential.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaCredentialRequest $request)
    {
        $this->socialMediaCredentialRepository->create($request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.social_media_credential.store'));
        return redirect()->route('admin.social_media_credential.index');
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
     * @param SocialMediaCredential $socialMediaCredential
     * @return Application|Factory|View
     */
    public function edit(SocialMediaCredential $socialMediaCredential)
    {
        return view('admin.social_media_credential.edit', compact('socialMediaCredential'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSocialMediaCredentialRequest $request
     * @param SocialMediaCredential $socialMediaCredential
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSocialMediaCredentialRequest $request, SocialMediaCredential $socialMediaCredential)
    {
        $this->socialMediaCredentialRepository->update($socialMediaCredential, $request->validated());
        session()->flash(NOTIFICATION_SUCCESS, __('success.social_media_credential.update'));
        return redirect()->route('admin.social_media_credential.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
