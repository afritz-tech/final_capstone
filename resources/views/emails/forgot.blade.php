@component('mail::message')
    <p>Hello Good Day {{ $user->name }}!</p>

    <p>We understand it happens.</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset Your Password
    @endcomponent

    <p>In case you have issues recovering your account, please contact us!</p>

    Thanks for your cooperation <br />
    {{ config('app.name') }}
@endcomponent
