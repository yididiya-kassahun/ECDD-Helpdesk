@extends('layouts.app')

@section('title', __('Manage Mailboxes'))

@section('content')
<div class="container">
    <div class="flexy-container">
        <div class="flexy-item">
            <span class="heading">{{ __('Mailboxes') }}</span>
        </div>
        @if (Auth::user()->isAdmin())
            <div class="flexy-item margin-left">
                <a href="{{ route('mailboxes.create') }}" class="btn btn-bordered">{{ __('New Mailbox') }}</a>
            </div>
        @endif
        <div class="flexy-block"></div>
    </div>

    <div class="card-list margin-top">
        @foreach ($mailboxes as $mailbox)
            <a href="{{ route('mailboxes.update', ['id'=>$mailbox->id]) }}" class="card @if (!Eventy::filter('mailbox.has_img', false, $mailbox)) no-img @endif hover-shade @if ($mailbox->isActive()) card-active @else card-inactive @endif">
                @action('mailbox_card.before_name', $mailbox)<h4>{{ $mailbox->name }}</h4>
                <p class="text-truncate">{{ $mailbox->email }}</p>
            </a>
        @endforeach
    </div>

</div>
@endsection
