@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Vehicle Info') }}</div>

                    <div class="card-body">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ __('Code') }}: {{ $vehicle->vehicle_code }}</li>
                            <li class="list-group-item">{{ __('Brand') }}: {{ $vehicle->brand->name }}</li>
                            <li class="list-group-item">{{ __('Engine Size') }}: {{ $vehicle->size }}</li>
                            <li class="list-group-item">{{ __('Model') }}: {{ $vehicle->model }}</li>
                            <li class="list-group-item">{{ __('Year') }}: {{ $vehicle->year }}</li>
                            <li class="list-group-item">{{ __('Series') }}: {{ $vehicle->series }}</li>
                            <li class="list-group-item">{{ __('Bike Model') }}: {{ $vehicle->model }}</li>
                            <li class="list-group-item">{{ __('Cylinder') }}: {{ $vehicle->cylinder }}</li>
                            <li class="list-group-item">{{ __('Configuration') }}: {{ $vehicle->configuration }}</li>
                            <li class="list-group-item">{{ __('Sales name') }}: {{ $vehicle->sales_name }}</li>
                            <li class="list-group-item">{{ __('Type of drive') }}: {{ $vehicle->type_of_drive }}</li>
                            <li class="list-group-item">{{ __('Engine output') }}: {{ $vehicle->engine_output }}</li>
                            <li class="list-group-item">{{ __('Country') }}: {{ $vehicle->country }}</li>
                            <li class="list-group-item">{{ __('Primary category') }}: {{ $vehicle->primary_category }}</li>
                            <li class="list-group-item">{{ __('Secondary category') }}: {{ $vehicle->secondary_category }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header">{{ __('Parts') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Active') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicle->parts as $part)
                                <tr>
                                    <th scope="row">{{ $part->part_code }}</th>
                                    <td>{{ $part->name }}</td>
                                    <td>{{ $part->active ? 'Yes' : 'No' }}</td>
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
