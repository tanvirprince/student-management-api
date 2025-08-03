@component('mail::message')
# Hello {{ $student->name }},

This is a reminder that your upcoming exam is scheduled for **{{ $examDate }}**.

Please be prepared.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
