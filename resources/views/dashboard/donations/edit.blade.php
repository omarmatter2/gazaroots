@extends('dashboard.layouts.app')

@section('title', 'Edit Donation')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Edit Donation</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.donations.index') }}" class="kt-link">Donations</a>
                <span>/</span>
                <span>#{{ $donation->id }}</span>
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

    <form action="{{ route('admin.donations.update', $donation) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="kt-card">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="donor_name">Donor Name <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input" id="donor_name" name="donor_name" value="{{ old('donor_name', $donation->donor_name) }}" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="donor_email">Donor Email</label>
                            <input type="email" class="kt-input" id="donor_email" name="donor_email" value="{{ old('donor_email', $donation->donor_email) }}">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="donor_phone">Donor Phone</label>
                            <input type="text" class="kt-input" id="donor_phone" name="donor_phone" value="{{ old('donor_phone', $donation->donor_phone) }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="water_project_id">Water Project</label>
                            <select class="kt-select" id="water_project_id" name="water_project_id">
                                <option value="">No Project</option>
                                @foreach($waterProjects as $project)
                                    <option value="{{ $project->id }}" {{ old('water_project_id', $donation->water_project_id) == $project->id ? 'selected' : '' }}>{{ $project->title_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="amount">Amount ($) <span class="text-danger">*</span></label>
                            <input type="number" class="kt-input" id="amount" name="amount" value="{{ old('amount', $donation->amount) }}" step="0.01" min="0" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="type">Type</label>
                            <select class="kt-select" id="type" name="type">
                                <option value="one_time" {{ old('type', $donation->type) == 'one_time' ? 'selected' : '' }}>One Time</option>
                                <option value="monthly" {{ old('type', $donation->type) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="status">Status</label>
                            <select class="kt-select" id="status" name="status">
                                <option value="pending" {{ old('status', $donation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('status', $donation->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ old('status', $donation->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ old('status', $donation->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="payment_method">Payment Method</label>
                            <select class="kt-select" id="payment_method" name="payment_method">
                                <option value="card" {{ old('payment_method', $donation->payment_method) == 'card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="paypal" {{ old('payment_method', $donation->payment_method) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                <option value="bank" {{ old('payment_method', $donation->payment_method) == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="cash" {{ old('payment_method', $donation->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="transaction_id">Transaction ID</label>
                        <input type="text" class="kt-input" id="transaction_id" name="transaction_id" value="{{ old('transaction_id', $donation->transaction_id) }}">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="notes">Notes</label>
                        <textarea class="kt-textarea" id="notes" name="notes" rows="3">{{ old('notes', $donation->notes) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="kt-card-footer flex justify-end gap-2.5 p-7.5 border-t border-border">
                <a href="{{ route('admin.donations.index') }}" class="kt-btn kt-btn-outline">Cancel</a>
                <button type="submit" class="kt-btn kt-btn-primary">Update Donation</button>
            </div>
        </div>
    </form>
</div>
@endsection

