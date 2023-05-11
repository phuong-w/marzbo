<?php

namespace App\Services\SocialMedia;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookService extends SocialMediaService
{
    public function request($method, $endpoint, $params = [])
    {
        $url = "https://graph.facebook.com/{$endpoint}";

        try {
            $response = Http::withOptions([
                'query' => $method === 'GET' ? $params : null,
                'form_params' => $method !== 'GET' ? $params : null,
            ])->send($method, $url);

            return $response->json();
        } catch (RequestException $e) {
            // Handle specific RequestException
            Log::error('RequestException: ' . $e->getMessage(), ['code' => $e->getCode()]);
            return false;
        } catch (\Exception $e) {
            // Handle general Exception
            Log::error('Exception: ' . $e->getMessage(), ['code' => $e->getCode()]);
            return false;
        }
    }

    public function sharePost($data)
    {
        if ($data['facebook_groups']) {
            foreach ($data['facebook_groups'] as $groupId) {
                $params = [
                    'access_token' => auth()->user()->facebook_access_token,
                    'message' => $data['content'][FACEBOOK],
                    'formatting' => 'MARKDOWN'
                ];

                $endpoint = "{$groupId}/feed";

                $response = $this->request('POST', $endpoint, $params);
            }
        }
    }

    /**
     * Get list groups user joined.
     *
     * @param $accessToken
     * @return mixed
     */
    public function getGroups($accessToken, $after = null, $groups = [])
    {
        $endpoint = 'me/groups';
        $params = ['access_token' => $accessToken];

        if ($after) {
            $params['after'] = $after;
        }

        $data = $this->request('GET', $endpoint, $params);

        // Merge data in to groups array
        $groups = array_merge($groups, $data['data']);

        if (isset($data['paging']['cursors']['after'])) {
            // Recursive call to load next page
            return $this->getGroups($accessToken, $data['paging']['cursors']['after'], $groups);
        }

        return $groups;
    }

    /**
     * Get list pages user manage.
     *
     * @param $accessToken
     * @return mixed
     */
    public function getPages($accessToken)
    {
        $endpoint = 'me/accounts';
        return $this->request('GET', $endpoint, ['access_token' => $accessToken]);
    }
}
