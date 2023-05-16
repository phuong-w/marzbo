<?php

namespace App\Repositories\Chatgpt;

use App\Models\Chatgpt;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;

/**
 * The repository for User Model
 */
class ChatgptRepository extends BaseRepository implements ChatgptRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(Chatgpt $model)
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

            $response = OpenAI::chat()->create([
                'model' => $this->model::GPT_MODEL,// 'gpt-3.5-turbo'
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
            Log::error($e->getMessage());
            return;
        }

    }
}
