@extends('admin.layouts.app')

@section('title', 'Distributor Request Details')

@section('content')
<div class="content-header">
    <h1>Distributor Request</h1>
    <a href="{{ route('admin.distributor-requests.index') }}" class="btn btn-secondary">← Back to List</a>
</div>

<div class="card" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px;">
    <h3 style="margin-bottom: 20px; color: #2d5016;">Request Information</h3>

    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <div>
            <strong>Company Name:</strong>
            <p>{{ $distributorRequest->company_name }}</p>
        </div>
        <div>
            <strong>Contact Name:</strong>
            <p>{{ $distributorRequest->contact_name }}</p>
        </div>
        <div>
            <strong>Email:</strong>
            <p><a href="mailto:{{ $distributorRequest->email }}">{{ $distributorRequest->email }}</a></p>
        </div>
        <div>
            <strong>Phone:</strong>
            <p>{{ $distributorRequest->phone ?? '-' }}</p>
        </div>
        <div>
            <strong>City:</strong>
            <p>{{ $distributorRequest->city ?? '-' }}</p>
        </div>
        <div>
            <strong>Country:</strong>
            <p>{{ $distributorRequest->country ?? '-' }}</p>
        </div>
        <div>
            <strong>Submitted:</strong>
            <p>{{ $distributorRequest->created_at->format('F d, Y \a\t H:i') }}</p>
        </div>
        <div>
            <strong>Current Status:</strong>
            <p>
                @php
                    $statusClass = match($distributorRequest->status) {
                        'pending' => 'badge-warning',
                        'reviewed' => 'badge-info',
                        'approved' => 'badge-success',
                        'rejected' => 'badge-danger',
                    };
                @endphp
                <span class="badge {{ $statusClass }}">{{ ucfirst($distributorRequest->status) }}</span>
            </p>
        </div>
    </div>

    @if($distributorRequest->message)
        <div style="margin-top: 20px;">
            <strong>Message:</strong>
            <p style="background: #f9f9f9; padding: 15px; border-radius: 4px; margin-top: 5px;">{{ $distributorRequest->message }}</p>
        </div>
    @endif
</div>

<div class="card" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h3 style="margin-bottom: 20px; color: #2d5016;">Update Status</h3>

    <form action="{{ route('admin.distributor-requests.update', $distributorRequest) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending" {{ old('status', $distributorRequest->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="reviewed" {{ old('status', $distributorRequest->status) === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                <option value="approved" {{ old('status', $distributorRequest->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ old('status', $distributorRequest->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="admin_notes">Admin Notes</label>
            <textarea name="admin_notes" id="admin_notes" rows="4"
                      class="form-control @error('admin_notes') is-invalid @enderror"
                      placeholder="Internal notes about this request...">{{ old('admin_notes', $distributorRequest->admin_notes) }}</textarea>
            @error('admin_notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Request</button>
        </div>
    </form>
</div>
@endsection
