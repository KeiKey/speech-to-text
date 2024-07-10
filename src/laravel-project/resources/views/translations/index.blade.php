@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('File Name') }}</th>
                                <th>{{ __('File') }}</th>
                                <th>{{ __('Translation') }}</th>
                                <th>{{ __('Prompt') }}</th>
                                <th>{{ __('Response Format') }}</th>
                                <th>{{ __('Temperature') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($translations as $translation)
                                <tr>
                                    <th scope="row">{{ $translation->id }}</th>
                                    <td>{{ $translation->name }}</td>
                                    <td>{{ $translation->file_name }}</td>
                                    <td>
                                        <a href="{{ route('translations.file_download', $translation) }}" class="btn btn-sm btn-primary">{{ __('Download File') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('translations.download', $translation) }}" class="btn btn-sm btn-primary">{{ __('Download Translation') }}</a>
                                    </td>
                                    <td>{{ $translation->prompt }}</td>
                                    <td>{{ $translation->response_format }}</td>
                                    <td>{{ $translation->temperature }}</td>
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
