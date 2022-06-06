<x-app-layout>
    <x-slot name="header">{{ __('urls.url') }}</x-slot>

    <div class="">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            <a class="btn btn-primary" href="{{ route('urls.create') }}" role="button">{{ __('general.create') }}</a>
        </div>

        <h2>{{ __('urls.url') }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">{{ __('urls.listing.id') }}</th>
                    <th scope="col">{{ __('urls.listing.name') }}</th>
                    <th scope="col">{{ __('urls.listing.address') }}</th>
                    <th scope="col">{{ __('urls.listing.last_status_code') }}</th>
                    <th scope="col">{{ __('urls.listing.last_verified_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($urls as $url)
                    <tr>
                        <th scope="row">
                            {{ $url->id }} &nbsp;
                            <a href="{{ route('urls.show', [$url->id]) }}">@include('icons.external')</a>
                        </th>
                        <td>{{ $url->name }}</td>
                        <td><a href="{{ $url->address }}" target="_blank">{{ $url->address }}</a></td>
                        <td>{{ $url->last_status_code }}</td>
                        <td>{{ $url->last_verified_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $urls->links() }}
    </div>
</x-app-layout>
