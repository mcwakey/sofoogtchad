<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        $faqs = $this->getFaqs();

        return view('contact.index', [
            'formAction' => route('contact.submit'),
            'submitText' => setting('contact_submit_text', 'Send Message'),
            'faqs' => $faqs,
        ]);
    }

    /**
     * Handle contact form submission.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'privacy_consent' => 'required|accepted',
        ]);

        // Store the contact message in database
        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        // Optionally send email notification
        // Mail::to(setting('contact_email', config('mail.from.address')))
        //     ->send(new \App\Mail\ContactFormSubmission($validated));

        return redirect()->route('contact.index')
            ->with('success', setting('contact_success_message', 'Thank you for your message! We will get back to you soon.'));
    }

    /**
     * Get FAQs from settings or return default array.
     */
    private function getFaqs(): ?array
    {
        $faqsJson = setting('contact_faqs');

        if (!$faqsJson) {
            return null;
        }

        if (is_array($faqsJson)) {
            return $faqsJson;
        }

        $faqs = json_decode($faqsJson, true);

        return is_array($faqs) && count($faqs) > 0 ? $faqs : null;
    }
}
