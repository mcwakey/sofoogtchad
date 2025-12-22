<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DistributorRequest;
use Illuminate\Http\Request;

class DistributorRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = DistributorRequest::latest();

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        $requests = $query->paginate(20);
        $pendingCount = DistributorRequest::pending()->count();

        return view('admin.distributor-requests.index', compact('requests', 'pendingCount'));
    }

    public function show(DistributorRequest $distributorRequest)
    {
        return view('admin.distributor-requests.show', compact('distributorRequest'));
    }

    public function update(Request $request, DistributorRequest $distributorRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $validated['reviewed_at'] = now();
        $distributorRequest->update($validated);

        return redirect()->route('admin.distributor-requests.index')
            ->with('success', 'Request updated successfully.');
    }

    public function destroy(DistributorRequest $distributorRequest)
    {
        $distributorRequest->delete();

        return redirect()->route('admin.distributor-requests.index')
            ->with('success', 'Request deleted successfully.');
    }
}
