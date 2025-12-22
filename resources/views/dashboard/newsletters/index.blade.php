@extends('dashboard.layouts.app')

@section('title', 'Newsletters')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-gray-900">Newsletters</h1>
            <p class="text-sm text-gray-600">Manage and send newsletters to subscribers</p>
        </div>
        <a href="{{ route('admin.newsletters.create') }}" class="kt-btn kt-btn-primary">
            <i class="ki-filled ki-plus-squared"></i>
            Create Newsletter
        </a>
    </div>

    <div class="kt-card">
        <div class="kt-card-table kt-scrollable-x-auto">
            <table class="kt-table kt-table-border">
                <thead>
                    <tr>
                        <th class="w-[60px]">#</th>
                        <th>Subject (EN)</th>
                        <th class="w-[120px]">Status</th>
                        <th class="w-[100px]">Recipients</th>
                        <th class="w-[100px]">Sent</th>
                        <th class="w-[150px]">Scheduled At</th>
                        <th class="w-[150px]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($newsletters as $newsletter)
                        <tr>
                            <td>{{ $newsletter->id }}</td>
                            <td>{{ Str::limit($newsletter->getTranslation('subject', 'en'), 50) }}</td>
                            <td>
                                @switch($newsletter->status)
                                    @case('draft')
                                        <span class="kt-badge kt-badge-sm kt-badge-secondary">Draft</span>
                                        @break
                                    @case('scheduled')
                                        <span class="kt-badge kt-badge-sm kt-badge-warning">Scheduled</span>
                                        @break
                                    @case('sending')
                                        <span class="kt-badge kt-badge-sm kt-badge-info">Sending...</span>
                                        @break
                                    @case('sent')
                                        <span class="kt-badge kt-badge-sm kt-badge-success">Sent</span>
                                        @break
                                    @case('failed')
                                        <span class="kt-badge kt-badge-sm kt-badge-danger">Failed</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ number_format($newsletter->recipients_count) }}</td>
                            <td>{{ number_format($newsletter->sent_count) }} / {{ number_format($newsletter->failed_count) }}</td>
                            <td>{{ $newsletter->scheduled_at?->format('M d, Y H:i') ?? '-' }}</td>
                            <td>
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('admin.newsletters.show', $newsletter) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="View">
                                        <i class="ki-filled ki-eye"></i>
                                    </a>
                                    @if($newsletter->isPending())
                                        <a href="{{ route('admin.newsletters.edit', $newsletter) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.newsletters.send-now', $newsletter) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-success" title="Send Now" onclick="return confirm('Send newsletter now?')">
                                                <i class="ki-filled ki-send"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($newsletter->status !== 'sending')
                                        <form action="{{ route('admin.newsletters.destroy', $newsletter) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger" title="Delete">
                                                <i class="ki-filled ki-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500">No newsletters found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($newsletters->hasPages())
            <div class="kt-card-footer justify-center">
                {{ $newsletters->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush

