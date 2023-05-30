@component('mail::message')
Dear User,

Your account has been deleted from Laravel_doc.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
