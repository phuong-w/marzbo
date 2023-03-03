@extends('admin.layouts.app')

@section('title', __('general.user.title'))

@section('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page"><span>{{ __('general.user.title') }}</span></li>
@endsection

@push('styles')
    @vite(['resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss'])
@endpush

@section('content')
    <div id="basic" class="col-lg-8 col-sm-12 col-12 layout-spacing">
        <form action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="layout-top-spacing mb-4">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-gray">{{ __('general.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('general.button.update') }}</button>
                    </div>
                    <div class="row">
                        <div class="form-group mb-4 col-md-6">
                            <label for="sFirstName">{{ __('general.common.first_name') }}</label>
                            <input type="text" name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror" id="sFirstName"
                                   placeholder="{{ __('general.common.first_name') }}"
                                   value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4 col-md-6">
                            <label for="sLastName">{{ __('general.common.last_name') }}</label>
                            <input type="text" name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror" id="sLastName"
                                   placeholder="{{ __('general.common.last_name') }}"
                                   value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="sEmail">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                               id="sEmail" placeholder="Email" value="{{ old('email') ? old('email') : $user->email }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="sPhone">{{ __('general.common.phone_number') }}</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               id="sPhone" placeholder="{{ __('general.common.phone_number') }}"
                               value="{{ old('phone', $user->phone ?? '') }}">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        @if (auth()->user()->can(Acl::PERMISSION_ASSIGNEE))
                            <label for="sRolePicker">{{ __('general.common.user_role') }}</label>
                            <div>
                                <select class="selectpicker w-100 @error('role') is-invalid @enderror" id="sRolePicker"
                                        title="Choose role" name="role[]" multiple>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->name }}"
                                            {{ checkOldArray($item->name, 'role', $user->getRoleNames()->toArray()) }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" name="role" value="{{ Acl::ROLE_CUSTOMER }}">
                        @endif
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
