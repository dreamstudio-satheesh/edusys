@extends('layouts.master')

@section('title')
    {{ __('students') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('students') }}
            </h3>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ __('create') . ' ' . __('students') }}
                        </h4>
                        <form class="pt-3 student-registration-form" id="create-form" data-success-function="formSuccessFunction" enctype="multipart/form-data" action="{{ route('students.store') }}" method="POST" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-3">
                                    <label>{{ __('Gr Number') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="admission_no" value="{{ $admission_no }}" readonly placeholder="{{ __('Gr Number') }}" class="form-control">
                                </div>

                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-3">
                                    <label for="class_section">{{ __('class_section') }} <span class="text-danger">*</span></label>
                                    <select name="class_section_id" id="class_section" class="form-control select2">
                                        <option value="">{{ __('select') . ' ' . __('Class') . ' ' . __('section') }}</option>
                                        @foreach ($class_sections as $class_section)
                                            <option value="{{ $class_section->id }}">{{ $class_section->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-3">
                                    <label for="session_year_id">{{ __('session_year') }} <span class="text-danger">*</span></label>
                                    <select name="session_year_id" id="session_year_id" class="form-control select2">
                                        @foreach ($sessionYears as $year)
                                            <option value="{{ $year->id }}" {{ $year->default == 1 ? 'selected' : '' }}>{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-3">
                                    <label>{{ __('admission_date') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="admission_date" placeholder="{{ __('admission_date') }}" class="datepicker-popup-no-future form-control" id="admission_date" autocomplete="off">
                                </div>

                                @if(!empty($features))
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                        <label>{{ __('Status') }} <span class="text-danger">*</span></label><br>
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="status" value="1">
                                                    {{ __('Active') }}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="status" value="0" checked>
                                                    {{ __('Inactive') }}
                                                </label>
                                            </div>
                                        </div>
                                        <span class="text-danger small">{{ __('Note').':-'.__('Activating this will consider in your current subscription cycle') }}</span>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('first_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" placeholder="{{ __('first_name') }}" class="form-control">
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('last_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" placeholder="{{ __('last_name') }}" class="form-control">
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('dob') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="dob" placeholder="{{ __('dob') }}" class="datepicker-popup-no-future form-control" autocomplete="off">
                                </div>

                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('gender') }} <span class="text-danger">*</span></label><br>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" value="male" checked>
                                                {{ __('male') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" value="female">
                                                {{ __('female') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label for="image">{{ __('image') }} </label>
                                    <input type="file" name="image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="{{ __('image') }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('mobile') }}</label>
                                    <input type="number" name="mobile" placeholder="{{ __('mobile') }}" min="0" class="form-control remove-number-increment">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label>{{ __('current_address') }} <span class="text-danger">*</span></label>
                                    <textarea name="current_address" required placeholder="{{ __('current_address') }}" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label>{{ __('permanent_address') }} <span class="text-danger">*</span></label>
                                    <textarea name="permanent_address" required placeholder="{{ __('permanent_address') }}" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            @if(count($extraFields))
                                <div class="row other-details">
                                    @foreach ($extraFields as $key => $data)
                                        <input type="hidden" name="extra_fields[{{ $key }}][id]" id="{{ $data->type }}_{{ $key }}_id">
                                        <input type="hidden" name="extra_fields[{{ $key }}][form_field_id]" value="{{ $data->id }}" id="{{ $data->type }}_{{ $key }}_id">

                                        <div class="form-group col-md-12 col-lg-6 col-xl-4 col-sm-12">
                                            @if($data->type != 'radio' && $data->type != 'checkbox')
                                                <label>{{ $data->name }} @if($data->is_required)<span class="text-danger">*</span>@endif</label>
                                            @endif

                                            @if($data->type == 'text')
                                                <input type="text" name="extra_fields[{{ $key }}][data]" class="form-control text-fields" id="{{ $data->type }}_{{ $key }}" placeholder="{{ $data->name }}" {{ $data->is_required ? 'required' : '' }}>
                                            @elseif($data->type == 'number')
                                                <input type="number" name="extra_fields[{{ $key }}][data]" min="0" class="form-control number-fields" id="{{ $data->type }}_{{ $key }}" placeholder="{{ $data->name }}" {{ $data->is_required ? 'required' : '' }}>
                                            @elseif($data->type == 'dropdown')
                                                <select name="extra_fields[{{ $key }}][data]" id="{{ $data->type }}_{{ $key }}" class="form-control select-fields" {{ $data->is_required ? 'required' : '' }}>
                                                    <option value="">{{ __('Select') . ' ' . $data->name }}</option>
                                                    @foreach($data->default_values as $value)
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            @elseif($data->type == 'radio')
                                                <label class="d-block">{{ $data->name }} @if($data->is_required)<span class="text-danger">*</span>@endif</label>
                                                <div class="row col-md-12 col-lg-12 col-xl-6 col-sm-12">
                                                    @foreach ($data->default_values as $value)
                                                        <div class="form-check mr-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" name="extra_fields[{{ $key }}][data]" value="{{ $value }}" class="radio-fields" {{ $data->is_required ? 'required' : '' }}>
                                                                {{ $value }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @elseif($data->type == 'checkbox')
                                                <label class="d-block">{{ $data->name }} @if($data->is_required)<span class="text-danger">*</span>@endif</label>
                                                <div class="row col-lg-12 col-xl-6 col-md-12 col-sm-12">
                                                    @foreach ($data->default_values as $value)
                                                        <div class="mr-2 form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" name="extra_fields[{{ $key }}][data][]" value="{{ $value }}" class="form-check-input chkclass checkbox-fields" {{ $data->is_required ? 'required' : '' }}>
                                                                {{ $value }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @elseif($data->type == 'textarea')
                                                <textarea name="extra_fields[{{ $key }}][data]" placeholder="{{ $data->name }}" id="{{ $data->type }}_{{ $key }}" class="form-control textarea-fields" {{ $data->is_required ? 'required' : '' }} rows="3"></textarea>
                                            @elseif($data->type == 'file')
                                                <div class="input-group col-xs-12">
                                                    <input type="file" name="extra_fields[{{ $key }}][data]" class="file-upload-default" id="{{ $data->type }}_{{ $key }}" {{ $data->is_required ? 'required' : '' }}>
                                                    <input type="text" class="form-control file-upload-info" disabled placeholder="{{ __('image') }}">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                                    </span>
                                                </div>
                                                <div id="file_div_{{ $key }}" class="mt-2 d-none file-div">
                                                    <a href="#" id="file_link_{{ $key }}" target="_blank">{{ $data->name }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <hr>
                            <div class="row mt-5">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label for="guardian_email">{{ __('guardian') . ' ' . __('email') }} <span class="text-danger">*</span></label>
                                    <!-- <select class="guardian-search form-control guardian_email" id="guardian_email"></select> -->
                                    <input type="text" name="guardian_email" class="form-control" id="guardian_email">
                                </div>

                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('guardian') . ' ' . __('first_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="guardian_first_name" placeholder="{{ __('guardian') . ' ' . __('first_name') }}" class="form-control" id="guardian_first_name">
                                </div>

                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('guardian') . ' ' . __('last_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="guardian_last_name" placeholder="{{ __('guardian') . ' ' . __('last_name') }}" class="form-control" id="guardian_last_name">
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                    <label>{{ __('guardian') . ' ' . __('mobile') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="guardian_mobile" placeholder="{{ __('guardian') . ' ' . __('mobile') }}" class="form-control remove-number-increment" id="guardian_mobile" min="1">
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label>{{ __('gender') }} <span class="text-danger">*</span></label><br>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="guardian_gender" value="male" id="guardian_male" checked>
                                                {{ __('male') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="guardian_gender" value="female" id="guardian_female">
                                                {{ __('female') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-4 col-lg-6 col-xl-4">
                                    <label for="guardian_image">{{ __('image') }} </label>
                                    <input type="file" name="guardian_image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" id="guardian_image" class="form-control file-upload-info" disabled placeholder="{{ __('image') }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                    <img id="guardian-image-preview" src="" alt="Guardian Image" class="img-fluid w-25">
                                </div>
                            </div>
                            <input class="btn btn-theme float-right ml-3" id="create-btn" type="submit" value="{{ __('submit') }}">
                            <input class="btn btn-secondary float-right" type="reset" value="{{ __('reset') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function formSuccessFunction() {
            setTimeout(() => {
                window.location.reload()
            }, 3000);
        }

        $('#admission_date').datepicker({
            format: "dd-mm-yyyy",
            rtl: isRTL()
        }).datepicker("setDate", 'now');
    </script>
@endsection
