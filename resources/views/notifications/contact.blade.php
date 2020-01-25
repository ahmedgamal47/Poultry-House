@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{!! $line !!}
@endforeach

{{-- Table Data --}}
@isset($records)
@component('mail::table')
| {{ __('messages.field') }} | {{ __('messages.value') }} |
| -------------------------- |:--------------------------:|
@foreach($records as $record)
| {{ $record['key'] }} | {{ $record['value'] }}
@endforeach
@endcomponent
@lang('validation.attributes.message')
@component('mail::panel')
{!! nl2br($message ) !!}
@endcomponent
@endisset

{{-- Action Button --}}
@isset($actionText)
@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('messages.regards'),<br>
{{ config('app.name') }}
@endif

@endcomponent