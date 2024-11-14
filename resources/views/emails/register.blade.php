@component('mail::message')
    <p>Hello Good Day {{ $user->name }}!</p>

    @component('mail::button', ['url' => url('verify/' . $user->remember_token)])
        Verify
    @endcomponent

    <p>In case you have issues please contact us!</p>
    Thanks for your cooperation <br />
    {{ config('app.name') }}
@endcomponent
