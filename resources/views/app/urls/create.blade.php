<x-app-layout>
    <x-slot name="header">{{ __('urls.url') }}</x-slot>

    <div class="">
        <div class="mb-4">
            <a class="btn btn-primary" href="{{ route('urls.index') }}" role="button">{{ __('general.back') }}</a>
        </div>

        <h2>{{ __('urls.new_url') }}</h2>

        <form method="post" action="{{ route('urls.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('urls.forms.create.name') }}</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">{{ __('urls.forms.create.address') }}</label>
                <input type="text" class="form-control" id="address" name="address"
                    placeholder="https://www.exemplo.com.br" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('general.send') }}</button>
        </form>

        <div class="mt-4">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
