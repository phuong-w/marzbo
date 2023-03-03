@extends('admin.layouts.app')

@section('title', __('general.post.title'))

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page"><span>{{ __('general.post.title') }}</span></li>
@endsection

@push('styles')
    @vite([
    'resources/sass/plugins/table/datatable/datatables.scss',
    'resources/sass/assets/forms/theme-checkbox-radio.scss',
    'resources/sass/plugins/table/datatable/dt-global_style.scss',
    'resources/sass/plugins/table/datatable/custom_dt_custom.scss',
    ])
@endpush

@section('content')
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                @can(Acl::PERMISSION_POST_ADD)
                    <div class="layout-top-spacing col-12">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">{{ __('general.button.create') }}</a>
                    </div>
                @endcan
                @include('admin.post.partials.dt_post_index_table')
            </div>
        </div>
    </div>
@endsection

@prepend('script')
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
@endprepend

