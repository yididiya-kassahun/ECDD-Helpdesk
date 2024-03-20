@if ($mailbox->before_reply){{ $mailbox->getReplySeparator() }}

@endif@php $is_forwarded = !empty($threads[0]) ? $threads[0]->isForwarded() : false; @endphp
@foreach ($threads as $thread)
@if (!$loop->first)-----------------------------------------------------------
## {{--@if ($loop->last){{ __(':person sent a message', ['person' => $thread->getFromName($mailbox)]) }}@else {{ __(':person replied', ['person' => $thread->getFromName($mailbox)]) }}@endif--}}{{ $thread->getFromName($mailbox) }}@if ($is_forwarded && $thread->from) <{{ $thread->from }}>@endif, {{ __('on :date', ['date' => App\Customer::dateFormat($thread->created_at, 'M j @ H:i')]) }} ({{ \Config::get('app.timezone') }}):@endif 
{{-- Html2Text\Html2Text::convert($thread->body) - this was causing "AttValue: " expected in Entity" error sometimes --}}{!! \Helper::htmlToText($thread->body, true) !!}
@if ($thread->source_via == App\Thread::PERSON_USER && \Eventy::filter('reply_email.include_signature', true, $thread))

{{-- Html2Text\Html2Text::convert($conversation->mailbox->signature) --}}{{ \Helper::htmlToText($conversation->getSignatureProcessed(['thread' => $thread])) }}
@endif
@endforeach
@if (\App\Option::get('email_branding'))
-----------------------------------------------------------
{!! __('Support powered by :app_name — Free open source help desk & shared mailbox', ['app_name' => \Config::get('app.name')]) !!}
@endif