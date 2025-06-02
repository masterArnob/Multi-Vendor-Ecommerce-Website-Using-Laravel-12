@php
    $user = Auth::user();
@endphp


this is user index - {{ $user->name }}

<br>

@if ($user->vendor_request === 0 && $user->role === 'user' && $user->user_status === 'active')
    <a href="{{ route('user.vendor-request.index') }}">Request too be Vendor</a>   
@endif
@if ($user->role === 'user' && $user->vendor_request === 1 && $user->vendor_status === 'pending' && $user->user_status === 'active')
    *************** Vendor Request Under Review ******************
@endif

@if ($user->role === 'user' && $user->vendor_request === 1 && $user->vendor_status === 'rejected' && $user->user_status === 'active')
    *************** Vendor Request Rejected ******************
@endif

@if ($user->role === 'user' && $user->vendor_request === 1 && $user->vendor_status === 'banned' && $user->user_status === 'active')
    *************** Vendor Banned ******************
@endif
 





    




<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form>