<div class="space-y-6 p-5">
    <h2 class="mb-4 text-lg text-gray">Email Logs</h2>
    @foreach($logs as $log)
        <div class="flex items-center justify-between border-b-2 border-gray-100 py-4">
            <div class="flex-1">
                #{{ $log->id }}
            </div>
            <div class="flex-1 truncate mr-5" title="{{ $log->message }}">
                {{ $log->message }}
            </div>

            <div class="flex items-center flex-1">
                <div class="text-sm text-gray-400">
                    Created {{ $log->created_at->diffForHumans() }}
                </div>
            </div>

            <div class="flex items-center flex-1 justify-end">
                <span class="px-4 mr-2 bg-{{ $log->status_label === 'undelivered' ? 'red' : ($log->status_label === 'delivered' ? 'green' : 'orange')  }}-600 text-white p-2 rounded  leading-none flex items-center text-sm uppercase">
                    {{ $log->status_label }}
                </span>
            </div>
        </div>
    @endforeach

    @empty($logs->items())
        <h2 class="text-md">No any Result :(</h2>
    @endif

    {{ $logs->links() }}
</div>
