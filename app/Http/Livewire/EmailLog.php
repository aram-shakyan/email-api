<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailLog extends Component
{
    public function render()
    {
        $logs = \App\Models\EmailLog::query()
            ->select('id', 'status', 'message', 'created_at')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy("created_at",'DESC')
            ->paginate(20);

        return view('livewire.email-log', [
            'logs' => $logs
        ]);
    }
}
