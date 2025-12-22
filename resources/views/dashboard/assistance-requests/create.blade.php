@extends('dashboard.layouts.app')

@section('title', 'Create Assistance Request')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Create Assistance Request</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.assistance-requests.index') }}" class="kt-link">Assistance Requests</a>
                <span>/</span>
                <span>Create</span>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="kt-alert kt-alert-danger mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-cross-circle"></i></div>
            <div class="kt-alert-content">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.assistance-requests.store') }}" method="POST">
        @csrf
        <div class="kt-card">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="full_name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="phone">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="email">Email</label>
                            <input type="email" class="kt-input" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="location">Location</label>
                            <input type="text" class="kt-input" id="location" name="location" value="{{ old('location') }}">
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="message">Message / Request Details <span class="text-danger">*</span></label>
                        <textarea class="kt-textarea" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="status">Status</label>
                        <select class="kt-select" id="status" name="status">
                            <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>New</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="admin_notes">Admin Notes</label>
                        <textarea class="kt-textarea" id="admin_notes" name="admin_notes" rows="3">{{ old('admin_notes') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="kt-card-footer flex justify-end gap-2.5 p-7.5 border-t border-border">
                <a href="{{ route('admin.assistance-requests.index') }}" class="kt-btn kt-btn-outline">Cancel</a>
                <button type="submit" class="kt-btn kt-btn-primary">Create Request</button>
            </div>
        </div>
    </form>
</div>
@endsection

