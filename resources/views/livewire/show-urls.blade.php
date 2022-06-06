<div>
    <div class="mb-4">
        <a class="btn btn-primary" href="{{ route('urls.create') }}" role="button">{{ __('general.create') }}</a>
        <a wire:click="onResetPage" class="btn btn-primary" role="button">{{ __('general.reload') }}</a>
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
                        <a class="text-decoration-none" href="{{ route('urls.show', [$url->id]) }}">{{ $url->id }} &nbsp; @include('icons.external')</a>
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
