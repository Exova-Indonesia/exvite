@component('mail::message')


@yield('header')


{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

@yield('content')

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

Terima kasih telah senantiasa menggunakan layanan Exova! <br>
Semoga kita semua selalu sehat, bahagia, dan kaya raya

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Hormat Kami,')<br>
{{ config('app.induk') }}
@endif
@endcomponent
