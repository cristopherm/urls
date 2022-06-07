<x-app-layout>
    <x-slot name="header">{{ __('urls.url') }}</x-slot>

    <div class="">
        @livewire('show-logs', ['url' => $url])
    </div>
</x-app-layout>
