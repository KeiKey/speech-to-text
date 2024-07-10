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
                                    {{ __('Language') }}
                                    <span class="bi bi-info-circle-fill" title="The language of the input audio. Supplying the input language in ISO-639-1 format will improve accuracy and latency."></span>
                                </label>

                                <div class="col-md-6">
                                    <select class="form-select form-control-rounded" id="language" name="language" required>
                                        @foreach($languages as $languageLabel => $language)
                                            <option
                                                value="{{ $language }}"
                                                @if($language == 'en') selected @endif
                                            >
                                                {{ $languageLabel }}
                                            </option>
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
                                    {{ __('Prompt') }}
                                    <i class="bi bi-info-circle-fill" title="An optional text to guide the model's style or continue a previous audio segment. The prompt should match the audio language."></i>
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
                                    {{ __('Response Format') }}
                                    <i class="bi bi-info-circle-fill" title="The format of the transcript output, in one of these options."></i>
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
                                    {{ __('Temperature') }} <i class="bi bi-info-circle-fill" title="The sampling temperature, between 0 and 1. "></i>
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
                                    {{ __('Timestamp granularity') }}
                                    <i class="bi bi-info-circle-fill" title="The timestamp granularities to populate for this transcription. response_format must be set verbose_json to use timestamp granularities."></i>
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
                                    {{ __('File') }}
                                    <i class="bi bi-info-circle-fill" title="The audio file to transcribe, in one of these formats: flac, mp3, mp4, mpeg, mpga, m4a, ogg, wav, or webm.Less than 25mb"></i>
                                </label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>

                                    @error('file')
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
