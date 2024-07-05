@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Translations') }}

                        <div>
                            <a href="{{ route('translations.create') }}" class="btn btn-sm btn-primary">{{ __('Create Translation') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('File') }}</th>
                                <th scope="col">{{ __('Transcription') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($translations as $translation)
                                <tr>
                                    <th scope="row">{{ $translation->id }}</th>
                                    <td>{{ $translation->name }}</td>
                                    <td>{{ $translation->name }}</td>
                                    <td class="d-flex justify-content-start">
                                        <form action="{{ route('translations.destroy', $translation) }}" method="POST">
                                            @csrf
                                            @method('Delete')

                                            <button class="btn btn-danger btn-sm" type="submit">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
