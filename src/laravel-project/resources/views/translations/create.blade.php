@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Translation') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('translations.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Translation name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="Translation name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prompt" class="col-md-4 col-form-label text-md-end">{{ __('Prompt') }}</label>

                                <div class="col-md-6">
                                    <input id="prompt" type="text" class="form-control @error('prompt') is-invalid @enderror" name="prompt" value="{{ old('prompt') }}">

                                    @error('prompt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="response_format" class="col-md-4 col-form-label text-md-end">{{ __('Response Format') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select form-control-rounded" id="response_format" name="response_format">
                                        @foreach($responseFormats as $responseFormatLabel => $responseFormat)
                                            <option value="{{ $responseFormat }}">{{ $responseFormatLabel }}</option>
                                        @endforeach
                                    </select>

                                    @error('response_format')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="temperature" class="col-md-4 col-form-label text-md-end">{{ __('Temperature') }}</label>

                                <div class="col-md-6">
                                    <input id="temperature" type="number" class="form-control @error('temperature') is-invalid @enderror" name="temperature" value="{{ old('temperature') }}">

                                    @error('temperature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('File') }}</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
