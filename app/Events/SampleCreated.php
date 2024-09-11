<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Sample;
use Illuminate\Support\Facades\Log;

class SampleCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct(Sample $sample)
    {
        Log::info('event created');
        $this->message =  $sample;
    }
    public function broadcastAs()
    {
        return 'sample.created';
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::info('event dispached');
        Log::info($this->message->metadata['opsCentralId']);

        return [
            new Channel('live-sample.' . $this->message->metadata['opsCentralId']),
        ];
    }
}
