<x-app-layout>
    <x-slot name="header">{{ __('urls.url') }}</x-slot>

    <div class="">
        <div class="mb-4">
            <form method="POST" action="{{ route('urls.destroy', [$url->id]) }}">
                @csrf
                @method('DELETE')
                <a class="btn btn-primary" href="{{ route('urls.index') }}" role="button">{{ __('general.back') }}</a>
                <button type="submit" class="btn btn-danger" role="button">{{ __('general.delete') }}</button>
            </form>
        </div>

        <h2>{{ $url->name }}</h2>
        <a class="lead" href="{{ $url->address }} " target="_blank"> {{ $url->address }}</a>

        <div class="mt-4">
            <h3>Logs</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('urls.show.status_code') }}</th>
                        <th scope="col">{{ __('urls.show.verified_at') }}</th>
                        <th scope="col">{{ __('urls.show.body') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($url->logs as $log)
                        <tr>
                            <td>{{ $log->status_code }}</td>
                            <td>{{ $log->created_at }}</td>
                            <td><a href="{{ route('urls.show_body', [$log->id]) }}">@include('icons.external')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
