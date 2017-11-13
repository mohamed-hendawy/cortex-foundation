{{-- Master Layout --}}
@extends('cortex/foundation::tenantarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ config('app.name') }} » {{ trans('cortex/foundation::common.tenantarea') }} » {{ $phrase }} » {{ $resource->username ?? $resource->name ?? $resource->slug ?? '' }}
@stop

{{-- Main Content --}}
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@yield('name', $resource->username ?? $resource->name ?? $resource->slug ?? '')</h1>
            <!-- Breadcrumbs -->
            {{ Breadcrumbs::render() }}
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @section('tabs')
                        <li><a href="{{ route("tenantarea.{$type}.edit", [str_singular($type) => $resource]) }}">{{ trans('cortex/foundation::common.details') }}</a></li>
                        <li class="active"><a href="#{{ $tab }}-tab" data-toggle="tab">{{ trans('cortex/foundation::common.'.$tab) }}</a></li>
                        <li style="float: right; padding: 5px"><select class="form-control dataTableBuilderLengthChanger" aria-controls="{{ $id }}-table"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></li>
                    @show
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="{{ $tab }}-tab">

                        {!! $dataTable->table(['class' => 'table table-striped responsive dataTableBuilder', 'id' => "{$id}"]) !!}

                    </div>

                </div>

            </div>

        </section>

    </div>

@endsection

@push('styles')
    <link href="{{ mix('css/datatables.css', 'assets') }}" rel="stylesheet">
@endpush

@push('scripts-vendor')
    <script src="{{ mix('js/datatables.js', 'assets') }}" type="text/javascript"></script>
@endpush

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
