<?php

namespace App\Repositories\ChatGpt;

use App\Models\ChatGpt;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;

/**
 * The repository for User Model
 */
class ChatGptRepository extends BaseRepository implements ChatGptRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(ChatGpt $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function updateOrCreate($data, $model)
    {
        try {
            $messages = [];
            if ($model) {
                $messages = $model->context;
            }
            $messages[] = [
                'role' => 'user',
                'content' => $data['promt']
            ];

            $client = auth()->user()->getOpenaiApiKey();

            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages
            ]);

            $messages[] = [
                'role' => 'assistant',
                'content' => $response->choices[0]->message->content
            ];

            return $this->model->updateOrCreate([
                'id' => $model ? $model->id : null,
                'user_id' => auth()->id()
            ], [
                'uuid' => (string) Str::uuid(),
                'context' => $messages
            ]);
        } catch (\Exception $e) {
            session()->flash(NOTIFICATION_ERROR, __('error.message', ['message' => $e->getMessage()]));
            return;
        }

    }
}
