@foreach ($messages as $message)
    <li class="{{ ($message->from == Auth::id()) ? 'replies' : 'sent' }}">
        <p>{{ $message->message }}</p>
    </li>
@endforeach