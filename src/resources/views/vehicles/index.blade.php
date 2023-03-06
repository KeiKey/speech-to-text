@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('partials.filters', ['filters' => ['brand', 'size', 'model', 'year']])

            <div class="card mt-5">
                <div class="card-header">{{ __('Vehicles') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Brand') }}</th>
                            <th scope="col">{{ __('Engine Size') }}</th>
                            <th scope="col">{{ __('Model') }}</th>
                            <th scope="col">{{ __('Year') }}</th>
                            <th scope="col">{{ __('Series') }}</th>
                            <th scope="col">{{ __('Bike Model') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <th scope="row">{{ $vehicle->vehicle_code }}</th>
                                <td>{{ $vehicle->brand->name }}</td>
                                <td>{{ $vehicle->size }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->year }}</td>
                                <td>{{ $vehicle->series }}</td>
                                <td>{{ $vehicle->model }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                {!! $vehicles->appends(request()->query())->links() !!}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
