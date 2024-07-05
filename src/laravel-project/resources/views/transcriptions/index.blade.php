@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Transcriptions') }}

                        <div>
                            <a href="{{ route('transcriptions.create') }}" class="btn btn-sm btn-primary">{{ __('Create Transcription') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('File') }}</th>
                                <th>{{ __('Transcription') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transcriptions as $transcription)
                                <tr>
                                    <th scope="row">{{ $transcription->id }}</th>
                                    <td>{{ $transcription->name }}</td>
                                    <td>{{ $transcription->name }}</td>
                                    <td class="d-flex justify-content-start">
                                        <form action="{{ route('transcriptions.destroy', $transcription) }}" method="POST">
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
