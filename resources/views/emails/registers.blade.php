@component('mail::message')
# Welcome to Our Website elemandental
welcome {{$mailData['email']}}.

your verification code is {{$mailData['code']}}.

Thanks,<br>
{{ config('Test') }}
@endcomponent
