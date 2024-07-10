@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Transcription') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('transcriptions.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Transcription name') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="Transcription name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="language" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Language') }} <i class="bi bi-info-circle-fill"></i>
                                </label>

                                <div class="col-md-6">
                                    <select class="form-select form-control-rounded" id="language" name="language" required>
                                        @foreach($languages as $languageLabel => $language)
                                            <option value="{{ $language }}">{{ $languageLabel }}</option>
                                        @endforeach
                                    </select>

                                    @error('language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prompt" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Prompt') }} <i class="bi bi-info-circle-fill"></i>
                                </label>

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
                                <label for="response_format" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Response Format') }} <i class="bi bi-info-circle-fill"></i>
                                </label>

                                <div class="col-md-6">
                                    <select class="form-select form-control-rounded" id="response_format" name="response_format" required>
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
                                <label for="temperature" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Temperature') }} <i class="bi bi-info-circle-fill"></i>
                                </label>

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
                                <label for="timestamp_granularity" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Timestamp granularity') }} <i class="bi bi-info-circle-fill"></i>
                                </label>

                                <div class="col-md-6">
                                    <select class="form-select form-control-rounded" id="timestamp_granularity" name="timestamp_granularity" required>
                                        @foreach($timestampGranularities as $timestampGranularityLabel => $timestampGranularity)
                                            <option value="{{ $timestampGranularity }}">{{ $timestampGranularityLabel }}</option>
                                        @endforeach
                                    </select>

                                    @error('timestamp_granularity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-end">
                                    {{ __('File') }} <i class="bi bi-info-circle-fill"></i>
                                </label>

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