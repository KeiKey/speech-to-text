<form action="{{ Request::url() }}" method="GET">
    <div class="card-body">
        <h4>{{ __('Filters') }}</h4>

        <div class="row mb-3">
            @if (in_array('brand', $filters))
                <div class="col-md-3">
                    <label for="brand" class="text-md-right">{{ __('Brand') }}</label>

                    <select class="form-select form-control-rounded small" id="brand" name="brand" onchange="this.form.submit()">
                        <option value="" selected>{{ __('Select brand') }}</option>

                        @foreach($brands as $id => $brand)
                            <option value="{{ $id }}" {{ $id == request('brand') ? ' selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if (in_array('size', $filters))
                <div class="col-md-3">
                    <label for="size" class="text-md-right">{{ __('Engine Size') }}</label>

                    <select class="form-select form-control-rounded small" id="size" name="size" onchange="this.form.submit()">
                        <option value="" selected>{{ __('Select Engine Size') }}</option>

                        @foreach($sizes as $size)
                            <option value="{{ $size }}" {{ $size == request('size') ? ' selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if (in_array('model', $filters))
                <div class="col-md-3">
                    <label for="model" class="text-md-right">{{ __('Model') }}</label>

                    <select class="form-select form-control-rounded small" id="model" name="model" onchange="this.form.submit()">
                        <option value="" selected>{{ __('Select Model') }}</option>

                        @foreach($models as $model)
                            <option value="{{ $model }}" {{ $model == request('model') ? ' selected' : '' }}>{{ $model }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if (in_array('year', $filters))
                <div class="col-md-3">
                    <label for="year" class="text-md-right">{{ __('Year') }}</label>

                    <select class="form-select form-control-rounded small" id="year" name="year" onchange="this.form.submit()">
                        <option value="" selected>{{ __('Select Year') }}</option>

                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $year == request('year') ? ' selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        <div class="row mb-3">
            <div class="col-md-4 select-wrapper">
                <button type="button" class="btn btn-outline-danger btn-sm"
                        onclick="window.location.href = window.location.href.split('?')[0];"
                >{{ __('Clear Filters') }}</button>
            </div>
        </div>
    </div>
</form>
