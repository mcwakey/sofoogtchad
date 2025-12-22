<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\DistributorRequest;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        $partners = Partner::active()->ordered()->get();
        $featuredPartners = $partners->where('is_featured', true);

        return view('partners.index', compact('partners', 'featuredPartners'));
    }

    public function showDistributorForm()
    {
        return view('partners.become-distributor');
    }

    public function submitDistributorRequest(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:2000',
        ]);

        DistributorRequest::create($validated);

        return redirect()->route('partners.become-distributor')
            ->with('success', 'Thank you for your interest! We will review your request and contact you soon.');
    }
}
