<?php

namespace App\Observers;

use App\Models\FacebookGroup;
use App\Models\SocialMediaCredential;
use App\Services\SocialMedia\FacebookService;

class SocialMediaCredentialObserver
{
    private $facebookService;
    public function __construct(
        FacebookService $facebookService
    ) {
        $this->facebookService = $facebookService;
    }

    /**
     * Handle the SocialMediaCredential "created" event.
     */
    public function created(SocialMediaCredential $socialMediaCredential): void
    {
        if ($socialMediaCredential->socialMedia(FACEBOOK)) {
            $this->updateOrCreateFacebookGroup($socialMediaCredential);
        }
    }

    /**
     * Handle the SocialMediaCredential "updated" event.
     */
    public function updated(SocialMediaCredential $socialMediaCredential): void
    {
        if ($socialMediaCredential->socialMedia(FACEBOOK)) {
            $this->updateOrCreateFacebookGroup($socialMediaCredential);
        }
    }

    /**
     * Handle the SocialMediaCredential "deleted" event.
     */
    public function deleted(SocialMediaCredential $socialMediaCredential): void
    {
        //
    }

    /**
     * Handle the SocialMediaCredential "restored" event.
     */
    public function restored(SocialMediaCredential $socialMediaCredential): void
    {
        //
    }

    /**
     * Handle the SocialMediaCredential "force deleted" event.
     */
    public function forceDeleted(SocialMediaCredential $socialMediaCredential): void
    {
        //
    }

    /**
     * Perform the updateOrCreate task for FacebookGroup model.
     *
     * @param SocialMediaCredential $socialMediaCredential
     * @return void
     */
    protected function updateOrCreateFacebookGroup(SocialMediaCredential $socialMediaCredential)
    {
        $groups = $this->facebookService->getGroups($socialMediaCredential->facebook_access_token);

        if (!empty($groups)) {
            // Loop through the list of groups from the API response to update or create new records in the groups table.
            foreach ($groups as $group) {
                $socialMediaCredential->facebookGroups()->updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'group_id' => $group['id']
                    ],
                    [
                        'group_name' => $group['name'],
                        'credentials' => $group
                    ]
                );
            }

            // Loop through the records in the groups table to search for groups that are not present in the API response and delete them from the database.
            foreach ($socialMediaCredential->facebookGroups as $group) {
                if (!in_array($group->group_id, array_column($groups, 'id'))) {
                    $group->delete();
                }
            }
        }
    }
}
