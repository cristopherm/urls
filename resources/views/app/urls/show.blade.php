<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Url') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <form method="POST" action="{{ route('urls.destroy', [$url->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary" role="button">Excluir</button>
                        </form>
                    </div>

                    <h2>{{ $url->name }}</h2>
                    <a class="lead" href="{{ $url->address }}"> {{ $url->address }}</a>

                    <div class="mt-4">
                        <h3>Logs</h3>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Status code</th>
                                    <th scope="col">Body</th>
                                    <th scope="col">Data de criação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($url->logs as $log)
                                    <tr>
                                        <td>{{ $log->status_code }}</td>
                                        <td>{{ str()->limit($log->body, 200) }}</td>
                                        {{-- <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bodyModal">
                                                Launch demo modal
                                            </button>
                                        </td> --}}
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- @include('app.urls.components.view_body') --}}

</x-app-layout>
