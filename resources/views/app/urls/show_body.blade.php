<x-app-layout>
    <x-slot name="header">{{ __('urls.url') }}</x-slot>

    <div class="">
        <div class="mb-4">
            <a class="btn btn-primary" href="{{ route('urls.show', [$log->url_id]) }}" role="button">{{ __('general.back') }}</a>
        </div>

        <h2>{{ __('urls.show_body.body') }}</h2>

        <h3 class="mt-4">{{ __('urls.show_body.code') }}</h3>
        <pre class="mt-4">
            <code>{{ $log->body }}</code>
        </pre>

        <h3 class="mt-4">{{ __('urls.show_body.preview') }}</h3>
        <iframe class="w-100" srcdoc="{{ $log->body }}"></iframe>
    </div>
</x-app-layout>
