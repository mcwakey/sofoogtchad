<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'read') {
                $query->read();
            } elseif ($request->status === 'unread') {
                $query->unread();
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(15);
        $unreadCount = ContactMessage::unread()->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified message.
     */
    public function show(ContactMessage $message)
    {
        // Mark as read when viewing
        $message->markAsRead();

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Toggle read status.
     */
    public function toggleRead(ContactMessage $message)
    {
        if ($message->is_read) {
            $message->markAsUnread();
            $status = 'unread';
        } else {
            $message->markAsRead();
            $status = 'read';
        }

        return redirect()->back()->with('success', "Message marked as {$status}.");
    }

    /**
     * Remove the specified message.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
