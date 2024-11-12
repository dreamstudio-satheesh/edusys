@extends('layouts.master')

@section('title')
    {{ __('staff') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('Manage Staff') }}
            </h3>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ __('Create Staff') }}
                        </h4>
                        <form class="pt-3 create-staff-form" id="create-form" action="{{ route('staff.store') }}" method="POST" novalidate="novalidate">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="role_id">{{ __('role') }} <span class="text-danger">*</span></label>
                                    <select name="role_id" id="role_id" class="form-control" required>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="first_name">{{ __('first_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" id="first_name" placeholder="{{__('first_name')}}" class="form-control" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="last_name">{{ __('last_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" id="last_name" placeholder="{{__('last_name')}}" class="form-control" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="mobile">{{ __('mobile') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="mobile" id="mobile" min="0" placeholder="{{__('contact')}}" class="form-control remove-number-increment" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="email">{{__('email') }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" placeholder="{{__('email')}}" class="form-control" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('image') }} <span class="text-info text-small">(308px*338px)</span></label>
                                    <input type="file" name="image" class="file-upload-default"/>
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}" required/>
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('dob') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="dob" required placeholder="{{ __('dob') }}" class="datepicker-popup-no-future form-control" autocomplete="off">
                                </div>
                                @if (Auth::user()->school_id)
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="salary">{{__('Salary') }} <span class="text-danger">*</span></label>
                                        <input type="number" name="salary" id="salary" placeholder="{{__('Salary')}}" class="form-control" min="0" value="0" required>
                                    </div>
                                @endif
                                @if (!Auth::user()->school_id)
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="assign_schools">{{__('assign') }} {{ __('schools') }}</label>
                                        <select name="school_id[]" class="form-control select2-dropdown select2-hidden-accessible" multiple>
                                            @foreach($schools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @hasFeature('Staff Management')
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('status') }} <span class="text-danger">*</span></label><br>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="status" value="1"> {{ __('Active') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="status" value="0" checked> {{ __('Inactive') }}
                                            </label>
                                        </div>
                                    </div>
                                    @if(!empty(Auth::user()->school_id))
                                        <span class="text-danger small">{{ __('Note').' :- '.__('Activating this will consider in your current subscription cycle') }}</span>
                                    @endif
                                </div>
                                @endHasFeature
                            </div>
                            <input class="btn btn-theme float-right ml-3" id="create-btn" type="submit" value={{ __('submit') }}>
                            <input class="btn btn-secondary float-right" type="reset" value={{ __('reset') }}>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
