@extends('layouts.master')

@section('title')
{{ __('certificate') }}
@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{ __('manage_certificate') . ' ' . __('template') }}
        </h3>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ __('edit_certificate') . ' ' . __('template') }}
                    </h4>
                    <form action="{{ route('certificate-template.update', $certificateTemplate->id) }}" method="post" class="edit-form-without-reset" novalidate="novalidate" enctype="multipart/form-data" data-success-function="formSuccessFunction">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            </div>
                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('type') }} <span class="text-danger">*</span></label>
                                <div class="col-12 d-flex row">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" {{ $certificateTemplate->type == 'Student' ? 'checked' : '' }} class="form-check-input certificate_type" name="type" value="Student" required="required">
                                            {{ __('student') }}
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" {{ $certificateTemplate->type == 'Staff' ? 'checked' : '' }} class="form-check-input certificate_type" name="type" value="Staff" required="required">
                                            {{ __('staff') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('page_layout') }} <span class="text-danger">*</span></label>
                                <select name="page_layout" class="form-control page_layout">
                                    <option value="A4 Landscape" {{ old('page_layout') == 'A4 Landscape' ? 'selected' : '' }}>A4 Landscape</option>
                                    <option value="A4 Portrait" {{ old('page_layout') == 'A4 Portrait' ? 'selected' : '' }}>A4 Portrait</option>
                                    <option value="Custom" {{ old('page_layout') == 'Custom' ? 'selected' : '' }}>Custom</option>
                                </select>

                            </div>

                            <div class="form-group col-sm-12 col-md-2">
                                <label>{{ __('height') }} <span class="text-small text-info">({{ __('mm') }})</span> <span class="text-danger">*</span></label>
                                <input type="number" name="height" value="{{ old('height') }}" class="form-control height" min="50">
                            </div>

                            <div class="form-group col-sm-12 col-md-2">
                                <label>{{ __('width') }} <span class="text-small text-info">({{ __('mm') }})</span> <span class="text-danger">*</span></label>
                                <input type="number" name="width" value="{{ old('width') }}" class="form-control width" min="50">
                            </div>

                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('user_image_shape') }} <span class="text-danger">*</span></label>
                                <select name="user_image_shape" class="form-control">
                                    <option value="Round" {{ old('user_image_shape') == 'Round' ? 'selected' : '' }}>Round</option>
                                    <option value="Square" {{ old('user_image_shape') == 'Square' ? 'selected' : '' }}>Square</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('image_size') }} <span class="text-small text-info">({{ __('px') }})</span><span class="text-danger">*</span></label>
                                <input type="number" name="image_size" value="{{ old('image_size') }}" class="form-control" min="50">
                            </div>

                            <div class="form-group col-sm-12 col-md-4">
                                <label>{{ __('background_image') }} <span class="text-danger">*</span></label>
                                <input type="file" name="background_image" id="thumbnail" class="file-upload-default" accept="image/*" />
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                        placeholder="{{ __('thumbnail') }}" aria-label="" />
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-theme"
                                            type="button">{{ __('upload') }}</button>
                                    </span>
                                </div>
                                <img src="{{ $certificateTemplate->background_image }}" class="img-fluid w-75 mt-2" alt="">
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>{{ __('description') }} <span class="text-danger">*</span></label>
                                <textarea id="tinymce_message" name="description" id="description" required placeholder="{{__('description')}}">{{ $certificateTemplate->description }}</textarea>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                @include('certificate.tags')
                            </div>

                        </div>
                        {{-- <input class="btn btn-theme" id="create-btn" type="submit" value={{ __('submit') }}> --}}
                        <input class="btn btn-theme float-right ml-3" id="create-btn" type="submit" value={{ __('submit') }}>
                        <input class="btn btn-secondary float-right" type="reset" value={{ __('reset') }}>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    window.onload = setTimeout(() => {
        $('.page_layout').trigger('change');
        $('.certificate_type').trigger('change');
    }, 500);

    function formSuccessFunction(response) {
        setTimeout(() => {
            // window.location.href = "{{route('certificate-template.index')}}"
        }, 2000);
    }
</script>
@endsection