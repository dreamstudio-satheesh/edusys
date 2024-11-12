@extends('layouts.master')

@section('title')
    {{ __('web_page') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('web_page') }}
            </h3>
        </div>
        <form class="pt-3 create-form-without-reset" action="{{ route('school.web-settings.store') }}" method="POST"
            novalidate="novalidate">
            @csrf
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            {{-- Theme color --}}
                            <div class="page-section">
                                <h4 class="card-title">
                                    {{ __('theme_color') }}
                                </h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="primary_color">{{ __('primary_color') }} <span class="text-danger">*</span></label>
                                        <input name="primary_color" id="primary_color" value="{{ $settings['primary_color'] ?? '#22577a' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="secondary_color">{{ __('secondary_color') }} <span class="text-danger">*</span></label>
                                        <input name="secondary_color" id="secondary_color" value="{{ $settings['secondary_color'] ?? '#38a3a5' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="primary_background_color">{{ __('primary_background_color') }} <span class="text-danger">*</span></label>
                                        <input name="primary_background_color" id="primary_background_color" value="{{ $settings['primary_background_color'] ?? '#f2f5f7' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="text_secondary_color">{{ __('text_secondary_color') }} <span class="text-danger">*</span></label>
                                        <input name="text_secondary_color" id="text_secondary_color" value="{{ $settings['text_secondary_color'] ?? '#2d2c2fb5' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="primary_hover_color">{{ __('primary_hover_color') }} <span class="text-danger">*</span></label>
                                        <input name="primary_hover_color" id="primary_hover_color" value="{{ $settings['primary_hover_color'] ?? '#143449' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                    </div>

                                </div>
                            </div>

                            {{-- About Us --}}
                            <div class="page-section mt-3">
                                <h4 class="card-title">
                                    {{ __('about_us') }}
                                </h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="about_us_title" value="{{ $settings['about_us_title'] ?? '' }}" class="form-control" placeholder="{{ __('title') }}" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('heading') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="about_us_heading" value="{{ $settings['about_us_heading'] ?? '' }}" class="form-control" placeholder="{{ __('heading') }}" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('description') }} <span class="text-danger">*</span></label>
                                        <textarea name="about_us_description" class="form-control" placeholder="{{ __('description') }}" required>{{ $settings['about_us_description'] ?? '' }}</textarea>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('image') }} <span class="text-danger">*</span> <span class="text-info text-small">(645px*555px)</span></label>
                                        <input type="file" name="about_us_image" class="file-upload-default" />
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}" required />
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                            </span>
                                        </div>
                                        @if ($settings['about_us_image'] ?? null)
                                            <img src="{{ $settings['about_us_image'] ?? null }}" class="img-fluid w-25" alt="">
                                        @endif

                                    </div>

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label>{{ __('status') }} <span class="text-danger">*</span></label><br>
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"> <input name="about_us_status" {{ isset($settings['about_us_status']) && $settings['about_us_status'] == 1 ? 'checked' : '' }} type="radio" value="1">{{ __('enable') }} <i class="input-helper"></i></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"> <input name="about_us_status" {{ isset($settings['about_us_status']) && $settings['about_us_status'] == 0 ? 'checked' : '' }} type="radio" value="0">{{ __('disable') }} <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Education programs --}}
                            <div class="page-section mt-3">
                                <h4 class="card-title">
                                    {{ __('education_program') }}
                                </h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="education_program_title" value="{{ $settings['education_program_title'] ?? '' }}" class="form-control" placeholder="{{ __('title') }}" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('heading') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="education_program_heading" value="{{ $settings['education_program_heading'] ?? '' }}" class="form-control" placeholder="{{ __('heading') }}" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('description') }} <span class="text-danger">*</span></label>
                                        <textarea name="education_program_description" class="form-control" placeholder="{{ __('description') }}" required>{{ $settings['education_program_description'] ?? '' }}</textarea>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label>{{ __('status') }} <span class="text-danger">*</span></label><br>
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"> <input name="education_program_status" {{ isset($settings['education_program_status']) && $settings['education_program_status'] == 1 ? 'checked' : '' }} type="radio" value="1">{{ __('enable') }} <i class="input-helper"></i></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"> <input name="education_program_status" type="radio" value="0" {{ isset($settings['education_program_status']) && $settings['education_program_status'] == 0 ? 'checked' : '' }}>{{ __('disable') }} <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Announcement --}}
                            <div class="page-section mt-3">
                                <h4 class="card-title">
                                    {{ __('announcement') }}
                                </h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="announcement_title" value="{{ $settings['announcement_title'] ?? '' }}" class="form-control" placeholder="{{ __('title') }}" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('heading') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="announcement_heading" value="{{ $settings['announcement_heading'] ?? '' }}" class="form-control" placeholder="{{ __('heading') }}" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('description') }} <span class="text-danger">*</span></label>
                                        <textarea name="announcement_description" class="form-control" placeholder="{{ __('description') }}" required>{{ $settings['announcement_description'] ?? '' }}</textarea>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>{{ __('image') }} <span class="text-danger">*</span><span class="text-info text-small">(595px*496px)</span></label>
                                        <input type="file" name="announcement_image" class="file-upload-default" />
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}" required />
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                            </span>
                                        </div>
                                        @if ($settings['announcement_image'] ?? null)
                                            <img src="{{ $settings['announcement_image'] ?? null }}" class="img-fluid w-25" alt="">
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-6 col-md-4">
                                        <label>{{ __('status') }} <span class="text-danger">*</span></label><br>
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"> <input name="announcement_status" {{ isset($settings['announcement_status']) && $settings['announcement_status'] == 1 ? 'checked' : '' }} type="radio" value="1">{{ __('enable') }} <i class="input-helper"></i></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"> <input name="announcement_status" {{ isset($settings['announcement_status']) && $settings['announcement_status'] == 0 ? 'checked' : '' }} type="radio" value="0">{{ __('disable') }} <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Submit and Reset --}}
                            <input class="btn btn-theme float-right ml-3" id="create-btn" type="submit" value={{ __('submit') }}>
                            <input class="btn btn-secondary float-right" type="reset" value={{ __('reset') }}>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
