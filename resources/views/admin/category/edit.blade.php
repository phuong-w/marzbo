@extends('admin.layouts.app')

@section('title', __('general.category.title'))

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page"><span>{{ __('general.category.title') }}</span></li>
@endsection

@push('styles')
    @vite(['resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss'])
@endpush

@section('content')
    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="layout-top-spacing mb-4">
                        <a href="{{ route('admin.category.index') }}"
                           class="btn btn-gray">{{ __('general.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('general.button.update') }}</button>
                    </div>
                    <div class="form-group mb-4">
                        <label for="sName">{{ __('general.common.name') }}</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               id="sName" placeholder="{{ __('general.common.name') }}"
                               value="{{ old('name', $category->name) }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="sSlug">Slug</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                               id="sSlug" placeholder="Slug" value="{{ old('slug', $category->slug) }}" readonly>
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="sStatus">{{ __('general.common.status') }}</label>
                        <div>
                            <select class="selectpicker w-100 @error('status') is-invalid @enderror" id="sStatus"
                                    title="Status" name="status" data-live-search="true">
                                <option value="" disabled>-- {{ __('general.choose.status') }} --</option>
                                <option value="{{ CONST_ENABLE }}" @selected(old('status', $category->status) == CONST_ENABLE)>
                                    {{ __('general.common.enable') }}</option>
                                <option value="{{ CONST_DISABLE }}" @selected(old('status', $category->status) == CONST_DISABLE)>
                                    {{ __('general.common.disable') }}</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@prepend('script')
    <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
@endprepend

@push('script')
@endpush
