@extends('admin.layouts.app')

@section('title', 'Distributor Requests')

@section('content')
<div class="content-header">
    <h1>Distributor Requests</h1>
    @if($pendingCount > 0)
        <span class="badge badge-warning" style="font-size: 1rem;">{{ $pendingCount }} pending</span>
    @endif
</div>

<div class="filters" style="margin-bottom: 20px;">
    <form method="GET" action="{{ route('admin.distributor-requests.index') }}" style="display: flex; gap: 10px;">
        <select name="status" class="form-control" style="width: auto;">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="reviewed" {{ request('status') === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
        @if(request('status'))
            <a href="{{ route('admin.distributor-requests.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>
</div>

@if($requests->isEmpty())
    <div class="empty-state">
        <p>No distributor requests found.</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Company</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Location</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->company_name }}</td>
                    <td>{{ $request->contact_name }}</td>
                    <td><a href="mailto:{{ $request->email }}">{{ $request->email }}</a></td>
                    <td>{{ $request->city ? $request->city . ', ' : '' }}{{ $request->country ?? '-' }}</td>
                    <td>
                        @php
                            $statusClass = match($request->status) {
                                'pending' => 'badge-warning',
                                'reviewed' => 'badge-info',
                                'approved' => 'badge-success',
                                'rejected' => 'badge-danger',
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ ucfirst($request->status) }}</span>
                    </td>
                    <td>{{ $request->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.distributor-requests.show', $request) }}" class="btn btn-sm btn-secondary">View</a>
                        <form action="{{ route('admin.distributor-requests.destroy', $request) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $requests->withQueryString()->links() }}
    </div>
@endif
@endsection
