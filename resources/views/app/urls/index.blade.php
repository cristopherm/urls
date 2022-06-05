<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-4">
                        <a class="btn btn-primary" href="{{ route('urls.create') }}" role="button">Novo</a>
                    </div>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Url</th>
                            {{-- <th scope="col">Ações</th> --}}
                            {{-- <th scope="col">Última vez verificado</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($urls as $url)
                            <tr>
                                <th scope="row">{{ $url->id }}</th>
                                <td>{{ $url->name }}</td>
                                <td>{{ $url->address }}</td>
                                {{-- <td>{{ $url->updated_at }}</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                      </table>

                    {{ $urls->links() }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
