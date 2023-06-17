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
        if ($data['facebook_group_id']) {
            $params = [
                'access_token' => $data['access_token'],
                'message' => $data['message'],
                'formatting' => 'MARKDOWN'
            ];

            $groupId = $data['facebook_group_id'];

            $endpoint = "{$groupId}/feed";

            return $this->request('POST', $endpoint, $params);
        }

        return false;
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

        if (isset($data['data'])) {
            // Merge data in to groups array
            $groups = array_merge($groups, $data['data']);

            if (isset($data['paging']['cursors']['after'])) {
                // Recursive call to load next page
                return $this->getGroups($accessToken, $data['paging']['cursors']['after'], $groups);
            }
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

    public function stats($accessToke, $post = null)
    {
        try {
            $totalComment = 0;
            $totalReact = 0;
            $totalView = 0;

            $externalPostId = $post->context->external_post_id;

            if (!$externalPostId) {
                return false;
            }

            $responseReact = $this->getReacts($accessToke, $externalPostId);
            $responseComment = $this->getComments($accessToke, $externalPostId);
//            $responseView = $this->getViews($accessToke, $externalPostId);

            if ($responseReact) {
                $totalReact = $responseReact['summary']['total_count'];
            }

            if ($responseComment) {
                $totalComment = $responseComment['summary']['total_count'];
            }

//            if ($responseView) {
//                $totalView = $responseView['summary']['total_count'];
//            }

            $post->update([
                'total_react' => $totalReact,
                'total_comment' => $totalComment,
                'total_view' => $totalView
            ]);

            return $post;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getComments($accessToken, $externalPostId)
    {
        $params = [
            'access_token' => $accessToken,
            'summary' => true
        ];

        $endpoint = "{$externalPostId}/comments";

        return $this->request('GET', $endpoint, $params);
    }

    public function getReacts($accessToken, $externalPostId)
    {
        $params = [
            'access_token' => $accessToken,
            'summary' => true
        ];

        $endpoint = "{$externalPostId}/reactions";

        return $this->request('GET', $endpoint, $params);
    }

    public function getViews($accessToken, $externalPostId)
    {
        $params = [
            'access_token' => $accessToken,
            'summary' => true
        ];

        $endpoint = "{$externalPostId}/seen";

        return $this->request('GET', $endpoint, $params);
    }
}
