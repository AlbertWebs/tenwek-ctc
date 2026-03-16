@extends('admin-dashboard.layouts.app')
@section('title', 'Enquiry')
@section('header', 'Enquiry')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap justify-between items-center gap-3 sm:px-6">
            <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $enquiry->status === 'new' ? 'bg-admin-gold/20 text-admin-gold-dark' : 'bg-gray-100 text-admin-muted' }}">{{ $enquiry->status }}</span>
            <form action="{{ route('admin-dashboard.enquiries.update', $enquiry) }}" method="post" class="flex gap-2">
                @csrf @method('PUT')
                <select name="status" onchange="this.form.submit()" class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-admin-teal">
                    <option value="new" {{ $enquiry->status === 'new' ? 'selected' : '' }}>New</option>
                    <option value="read" {{ $enquiry->status === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ $enquiry->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="archived" {{ $enquiry->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </form>
        </div>
        <div class="p-6 space-y-4">
            <div><span class="text-xs font-medium text-admin-muted uppercase">From</span><p class="font-medium text-admin-dark">{{ $enquiry->name }} &lt;{{ $enquiry->email }}&gt;</p></div>
            @if($enquiry->subject)<div><span class="text-xs font-medium text-admin-muted uppercase">Subject</span><p class="text-admin-dark">{{ $enquiry->subject }}</p></div>@endif
            @if($enquiry->source)<div><span class="text-xs font-medium text-admin-muted uppercase">Source</span><p class="text-admin-dark">{{ $enquiry->source }}</p></div>@endif
            <div><span class="text-xs font-medium text-admin-muted uppercase">Date</span><p class="text-admin-dark">{{ $enquiry->created_at->format('l, F j, Y \a\t g:i A') }}</p></div>
            <div><span class="text-xs font-medium text-admin-muted uppercase">Message</span><div class="mt-1 p-4 rounded-lg bg-admin-bg text-admin-dark whitespace-pre-wrap">{{ $enquiry->message }}</div></div>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 flex gap-3 sm:px-6">
            <a href="{{ route('admin-dashboard.enquiries.index') }}" class="text-sm font-medium text-admin-teal hover:underline">← Back to list</a>
            <form action="{{ route('admin-dashboard.enquiries.destroy', $enquiry) }}" method="post" class="inline" onsubmit="return confirm('Delete this enquiry?');">@csrf @method('DELETE')<button type="submit" class="text-sm text-admin-coral hover:underline">Delete</button></form>
        </div>
    </div>
@endsection
