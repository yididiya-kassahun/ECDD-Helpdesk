<div class="dropdown sidebar-title">
    <span class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        {{ $user->first_name }} {{ $user->last_name }} @if (isset($users) && count($users))<span class="caret"></span>@endif
    </span>
    @if (isset($users) && count($users))
        <ul class="dropdown-menu dm-scrollable">
            @foreach ($users as $user_item)
                <li @if ($user_item->id == $user->id)class="active"@endif><a href="{{ route('users.profile', ['id'=>$user_item->id]) }}">@if ($user_item->invite_state == App\User::INVITE_STATE_SENT || $user_item->invite_state == App\User::INVITE_STATE_NOT_INVITED) <i class="glyphicon @if ($user_item->invite_state == App\User::INVITE_STATE_SENT) glyphicon-hourglass @else glyphicon-remove @endif"></i> @endif{{ $user_item->first_name }} {{ $user_item->last_name }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
<ul class="sidebar-menu">
    <li @if (Route::currentRouteName() == 'users.profile')class="active"@endif><a href="{{ route('users.profile', ['id'=>$user->id]) }}"><i class="glyphicon glyphicon-user"></i> {{ __('Profile') }}</a></li>
    @action('user.profile.menu.after_profile', $user)
    @if (Auth::user()->isAdmin())
        <li @if (Route::currentRouteName() == 'users.permissions')class="active"@endif><a href="{{ route('users.permissions', ['id'=>$user->id]) }}"><i class="glyphicon glyphicon-ok"></i> {{ __('Permissions') }}</a></li>
    @endif
    <li @if (Route::currentRouteName() == 'users.notifications')class="active"@endif><a href="{{ route('users.notifications', ['id'=>$user->id]) }}"><i class="glyphicon glyphicon-bell"></i> {{ __('Notifications') }}</a></li>
    {{--<li @if (Route::currentRouteName() == 'user_autobcc')class="active"@endif><a href="#"><i class="glyphicon glyphicon-duplicate"></i> {{ __('Auto Bcc') }} (todo)</a></li>--}}
    {{--<li @if (Route::currentRouteName() == 'user_myapps')class="active"@endif><a href="#"><i class="glyphicon glyphicon-gift"></i> {{ __('My Apps') }} (todo)</a></li>--}}
</ul>
<a href="{{ route('users.create') }}" class="btn btn-bordered btn-sidebar">{{ __("New User") }}</a>