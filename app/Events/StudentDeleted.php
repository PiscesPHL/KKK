<?php

namespace App\Events;

use App\Models\Student;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentDeleted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Student $student) {}

    public function broadcastOn(): array
    {
        return [new Channel('students')];
    }

    public function broadcastAs(): string
    {
        return 'student.deleted';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->student->id,
            'first_name' => $this->student->first_name,
            'last_name' => $this->student->last_name,
        ];
    }
}
