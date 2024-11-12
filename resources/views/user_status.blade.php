@extends('layouts.master')

@section('title')
{{ __('user') }}
@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{ __('manage_user') }}
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ __('list_user') }}
                    </h4>
                    <div id="toolbar" class="row">
                        <div class="col-sm-12 col-md-3">
                            <label for="" class="filter-menu">{{ __('role') }}</label>
                            <select name="role" class="form-control role">
                                <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>{{ __('students') }}</option>
                                <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>{{ __('teachers_staffs') }}</option>
                            </select>

                        </div>
                        <div class="col-sm-12 col-md-3 class-section">
                            <label for="" class="filter-menu">{{ __('class_section') }}</label>
                            <select name="class_section_id" class="form-control class_section_id">
                                <option value="">{{ __('class_section') }}</option>
                                @foreach($classSection as $value => $label)
                                <option value="{{ $value }}" {{ old('class_section_id') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <form action="{{ url('users/status') }}" class="create-form" method="post">
                        <div class="row">
                            <div class="col-12">
                                <table aria-describedby="mydesc" class='table' id='table_list' data-toggle="table" data-url="{{ route('users.show') }}" data-click-to-select="true" data-side-pagination="server" data-pagination="false" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-maintain-selected="true" data-export-data-type='all' data-show-export="true" data-export-options='{ "fileName": "teacher-list-<?= date('d-m-y') ?>" ,"ignoreColumn":["operate"]}' data-query-params="userStatusQueryParams" data-escape="true">
                                    <thead>
                                        <tr>
                                            <th scope="col" data-field="id" data-visible="false">{{ __('id') }} </th>
                                            <th scope="col" data-field="no">{{ __('no.') }}</th>
                                            <th scope="col" data-field="image" data-formatter="imageFormatter"> {{ __('image') }}</th>
                                            <th scope="col" data-field="full_name">{{ __('full_name') }}</th>
                                            <th scope="col" data-field="type" data-formatter="userTypeFormatter"> {{ __('type') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-theme mt-3" value="{{ __('submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.role').change(function(e) {
        e.preventDefault();
        if ($(this).val() == 2) {
            $('.class-section').hide(500);
        } else {
            $('.class-section').show(500);
        }
    });
</script>
@endsection