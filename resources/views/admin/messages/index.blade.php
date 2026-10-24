@extends('admin.layout')
@section('title', 'Messages')
@section('content')
  @forelse ($messages as $message)
    <article class="panel" style="margin-bottom:12px">
      <div class="row">
        <strong>{{ $message->name }}</strong>
        <span class="muted">{{ $message->created_at->format('d M Y, h:i A') }}{{ $message->is_read ? '' : ' · new' }}</span>
      </div>
      <p>{{ $message->subject }}</p>
      <p>{{ $message->message }}</p>
      <p class="muted">{{ $message->phone }} @if ($message->email) · {{ $message->email }} @endif</p>
      @unless ($message->is_read)
        <form method="POST" action="{{ route('admin.messages.read', $message) }}">@csrf<button class="btn btn--small" type="submit">Mark as read</button></form>
      @endunless
    </article>
  @empty
    <p>No messages yet.</p>
  @endforelse
  <div class="pager">{{ $messages->links() }}</div>
@endsection
