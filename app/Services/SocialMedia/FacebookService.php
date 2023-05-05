<?php

namespace App\Services\SocialMedia;

use App\Models\FacebookGroup;
use Illuminate\Support\Facades\Http;

class FacebookService extends SocialMediaService
{
    public function fetchData()
    {
        // TODO: Implement fetchData() method.
    }

    public function sharePost($data)
    {
        if ($data['facebook_groups']) {
            foreach ($data['facebook_groups'] as $groupId) {
                $facebookGroup = FacebookGroup::where('group_id', $groupId);

                if ($facebookGroup) {
                    $response = Http::post("https://graph.facebook.com/$groupId/feed", [
                        'access_token' => auth()->user()->facebook_access_token,
                        'message' => $data['content'][FACEBOOK],
                        'formatting' => 'MARKDOWN'
                    ]);
                }
            }
        }
    }

    /**
     * Get list groups user joined.
     *
     * @param $accessToken
     * @return mixed
     */
    public function getGroups($accessToken)
    {
        $response = Http::get("https://graph.facebook.com/me/groups", [
            'access_token' => $accessToken,
        ]);

        return $response->json()['data'];
    }

    /**
     * Get list pages user manage.
     *
     * @param $accessToken
     * @return mixed
     */
    public function getPages($accessToken)
    {
        $response = Http::get("https://graph.facebook.com/me/accounts", [
            'access_token' => $accessToken,
        ]);

        return $response->json()['data'];
    }
}
