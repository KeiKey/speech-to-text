@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Imports Files Form') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('imports.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="importType" class="col-md-4 col-form-label text-md-right">{{ __('Import Type') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select form-control-rounded" id="importType" name="importType" required>
                                        @foreach($importTypes as $importType)
                                            <option value="{{ $importType }}">{{ $importType }}</option>
                                        @endforeach
                                    </select>

                                    @error('importType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="file" id="file" name="file" required>

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

                <div class="card mt-5">
                    <div class="card-header">{{ __('Your previous Imported Files') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('File Name') }}</th>
                                <th scope="col">{{ __('Import Type') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Result') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userImports as $userImport)
                                <tr>
                                    <th scope="row">{{ $userImport->id }}</th>
                                    <td>{{ $userImport->file_name }}</td>
                                    <td>{{ $userImport->import_type }}</td>
                                    <td>{{ $userImport->status }}</td>
                                    <td>{{ substr($userImport->result, 0, 75) }}</td>
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
