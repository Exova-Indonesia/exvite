@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')<br>
{{ 'Untuk pertanyaan lebih lanjut silakan hubungi email :' }} <a href="mailto:support@exova.id">support@exova.id</a> {{ '| phone :' }} <a href="https:://api.whatsapp/send?phone=6281238169667">+6281238169667</a>
@endcomponent
@endslot
@endcomponent
