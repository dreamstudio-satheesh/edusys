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
                        {{ __('list') . ' ' . __('students') }}
                    </h4>
                    <div class="row" id="toolbar">
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="filter-menu">{{ __('Class Section') }} <span class="text-danger">*</span></label>
                            <select name="filter_class_section_id" id="filter_class_section_id" class="form-control">
                                <option value="">{{ __('select_class_section') }}</option>
                                @foreach ($class_sections as $class_section)
                                <option value={{ $class_section->id }}>{{$class_section->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="filter-menu">{{ __('Session Year') }} <span class="text-danger">*</span></label>
                            <select name="filter_session_year_id" id="filter_session_year_id" class="form-control">
                                @foreach ($sessionYears as $sessionYear)
                                <option value={{ $sessionYear->id }} {{$sessionYear->default==1?"selected":""}}>{{$sessionYear->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @can('student-delete')
                        <div class="form-group col-12">
                            <button id="update-status" class="btn btn-secondary" disabled><span class="update-status-btn-name">{{ __('Inactive') }}</span></button>
                        </div>
                        @endcan
                    </div>

                    @can('student-delete')
                    <div class="col-12 mt-4 text-right">
                        <b><a href="#" class="table-list-type active mr-2" data-id="0">{{__('active')}}</a></b> | <a href="#" class="ml-2 table-list-type" data-id="1">{{__("Inactive")}}</a>
                    </div>
                    @endcan
                    <div class="row">
                        <div class="col-12">
                            <table aria-describedby="mydesc" class='table' id='table_list'
                                data-toggle="table" data-url="{{ route('students.show',[1]) }}" data-click-to-select="true"
                                data-side-pagination="server" data-pagination="true"
                                data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true"
                                data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-fixed-columns="false"
                                data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id"
                                data-sort-order="desc" data-maintain-selected="true" data-export-types="['pdf','json', 'xml', 'csv', 'txt', 'sql', 'doc', 'excel']" data-show-export="true"
                                data-export-options='{ "fileName": "students-list-<?= date('d-m-y') ?>" ,"ignoreColumn": ["operate"]}' data-query-params="studentDetailsQueryParams"
                                data-check-on-init="true" data-escape="true">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th scope="col" data-field="id" data-sortable="true" data-visible="false">{{ __('id') }}</th>
                                        <th scope="col" data-field="no">{{ __('no.') }}</th>
                                        <th scope="col" data-field="user.id" data-visible="false">{{ __('User Id') }}</th>
                                        <th scope="col" data-field="user.full_name">{{ __('name') }}</th>
                                        <th scope="col" data-field="user.dob" data-formatter="dateFormatter">{{ __('dob') }}</th>
                                        <th scope="col" data-field="user.image" data-formatter="imageFormatter">{{ __('image') }}</th>
                                        <th scope="col" data-field="class_section.full_name">{{ __('class_section') }}</th>
                                        <th scope="col" data-field="admission_no"> {{ __('Gr Number') }}</th>
                                        <th scope="col" data-field="roll_number">{{ __('roll_no') }}</th>
                                        <th scope="col" data-field="user.gender">{{ __('gender') }}</th>
                                        <th scope="col" data-field="admission_date" data-formatter="dateFormatter">{{ __('admission_date') }}</th>
                                        <th scope="col" data-field="guardian.email">{{ __('guardian') . ' ' . __('email') }}</th>
                                        <th scope="col" data-field="guardian.full_name">{{ __('guardian') . ' ' . __('name') }}</th>
                                        <th scope="col" data-field="guardian.mobile">{{ __('guardian') . ' ' . __('mobile') }}</th>
                                        <th scope="col" data-field="guardian.gender">{{ __('guardian') . ' ' . __('gender') }}</th>

                                        {{-- Admission form fields --}}
                                        @foreach ($extraFields as $field)
                                        <th scope="col" data-visible="false" data-escape="false" data-field="{{ $field->name }}">{{ $field->name }}</th>
                                        @endforeach
                                        {{-- End admission form fields --}}

                                        @canany(['student-edit','student-delete'])
                                        <th data-events="studentEvents" class="align-button text-center" scope="col" data-field="operate" data-escape="false">{{ __('action') }}</th>
                                        @endcanany
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@can('student-edit')
<div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">{{ __('edit') . ' ' . __('students') }}</h4><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
            </div>
            <form id="edit-form" class="edit-student-registration-form" novalidate="novalidate" action="{{ url('students') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Admission Number Field (readonly) -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('admission_no') }} <span class="text-danger">*</span></label>
                            <input type="text" name="admission_no" placeholder="{{ __('admission_no') }}" class="form-control" id="edit_admission_no" readonly />
                        </div>

                        <!-- Session Year Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('Session Year') }} <span class="text-danger">*</span></label>
                            <select required name="session_year_id" class="form-control" id="session_year_id">
                                @foreach ($sessionYears as $sessionYear)
                                <option value="{{ $sessionYear->id }}">{{ $sessionYear->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Class Section Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('Class Section') }} <span class="text-danger">*</span></label>
                            <select required name="class_section_id" class="form-control" id="edit_student_class_section_id">
                                <option value="">{{ __('select_class_section') }}</option>
                                @foreach ($class_sections as $class_section)
                                <option value="{{ $class_section->id }}">{{ $class_section->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5">
                        <!-- First Name Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('first_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" placeholder="{{ __('first_name') }}" class="form-control" id="edit_first_name" />
                        </div>

                        <!-- Last Name Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('last_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" placeholder="{{ __('last_name') }}" class="form-control" id="edit_last_name" />
                        </div>

                        <!-- Date of Birth Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('dob') }} <span class="text-danger">*</span></label>
                            <input type="text" name="dob" placeholder="{{ __('dob') }}" class="datepicker-popup-no-future form-control" id="edit_dob" />
                        </div>

                        <!-- Gender Radio Buttons -->
                        <div class="form-group col-sm-12 col-md-4">
                            <label>{{ __('gender') }} <span class="text-danger">*</span></label><br>
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="male" id="male" class="form-check-input" />
                                    <label class="form-check-label" for="male">{{ __('male') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="female" id="female" class="form-check-input" />
                                    <label class="form-check-label" for="female">{{ __('female') }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('image') }}</label>
                            <input type="file" name="image" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}" id="edit_image" />
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                </span>
                            </div>
                            <div style="width: 100px;">
                                <img src="" id="edit-student-image-tag" class="img-fluid w-100" alt="" />
                            </div>
                        </div>

                        <!-- Mobile Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('mobile') }}</label>
                            <input type="number" name="mobile" placeholder="{{ __('mobile') }}" min="1" class="form-control remove-number-increment" id="edit_mobile" />
                        </div>

                        <!-- Current Address Field -->
                        <div class="form-group col-sm-12 col-md-6">
                            <label>{{ __('current_address') }} <span class="text-danger">*</span></label>
                            <textarea name="current_address" required placeholder="{{ __('current_address') }}" class="form-control" rows="3" id="edit-current-address"></textarea>
                        </div>

                        <!-- Permanent Address Field -->
                        <div class="form-group col-sm-12 col-md-6">
                            <label>{{ __('permanent_address') }} <span class="text-danger">*</span></label>
                            <textarea name="permanent_address" required placeholder="{{ __('permanent_address') }}" class="form-control" rows="3" id="edit-permanent-address"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Reset Password Checkbox -->
                        <div class="form-group col-sm-12 col-md-4">
                            <div class="d-flex">
                                <div class="form-check w-fit-content">
                                    <input type="checkbox" class="form-check-input" name="reset_password" value="1" id="reset_password">
                                    <label class="form-check-label ml-4" for="reset_password">{{ __('reset_password') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Guardian Details -->
                    <div class="row mt-5">
                        <!-- Guardian Email -->
                        <div class="form-group col-sm-12 col-md-12">
                            <label>{{ __('guardian') . ' ' . __('email') }} <span class="text-danger">*</span></label>
                            <select class="edit-guardian-search form-control" name="guardian_id"></select>
                            <input type="hidden" id="edit_guardian_email" name="guardian_email">
                        </div>

                        <!-- Guardian First Name -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('guardian') . ' ' . __('first_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="guardian_first_name" placeholder="{{ __('guardian') . ' ' . __('first_name') }}" class="form-control" id="edit_guardian_first_name" />
                        </div>

                        <!-- Guardian Last Name -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('guardian') . ' ' . __('last_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="guardian_last_name" placeholder="{{ __('guardian') . ' ' . __('last_name') }}" class="form-control" id="edit_guardian_last_name" />
                        </div>

                        <!-- Guardian Mobile -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('guardian') . ' ' . __('mobile') }} <span class="text-danger">*</span></label>
                            <input type="number" name="guardian_mobile" placeholder="{{ __('guardian') . ' ' . __('mobile') }}" class="form-control remove-number-increment" min="1" id="edit_guardian_mobile" />
                        </div>

                        <!-- Guardian Gender Radio Buttons -->
                        <div class="form-group col-sm-12 col-md-12">
                            <label>{{ __('gender') }} <span class="text-danger">*</span></label><br>
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="guardian_gender" value="male" id="edit-guardian-male" class="form-check-input" />
                                    <label class="form-check-label" for="edit-guardian-male">{{ __('male') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="guardian_gender" value="female" id="edit-guardian-female" class="form-check-input" />
                                    <label class="form-check-label" for="edit-guardian-female">{{ __('female') }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Image Upload Field -->
                        <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <label>{{ __('image') }}</label>
                            <input type="file" name="guardian_image" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}" id="edit_image" />
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                </span>
                            </div>
                            <div style="width: 100px;">
                                <img src="" id="edit-guardian-image-tag" class="img-fluid w-100" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <input class="btn btn-theme" type="submit" value="{{ __('submit') }}">
                </div>
            </form>

        </div>
    </div>
</div>
@endcan
@endsection
@section('script')
<script>
    let userIds;
    $('.table-list-type').on('click', function(e) {
        let value = $(this).data('value');
        let ActiveLang = window.trans['Active'];
        let DeactiveLang = window.trans['Inactive'];
        if (value === "" || value === "active" || value == null) {
            $("#update-status").data("id")
            $('.update-status-btn-name').html(DeactiveLang);
        } else {
            $('.update-status-btn-name').html(ActiveLang);
        }
    })


    function updateUserStatus(tableId, buttonClass) {
        let selectedRows = $(tableId).bootstrapTable('getSelections');
        let selectedRowsValues = selectedRows.map(function(row) {
            return row.user_id;
        });
        userIds = JSON.stringify(selectedRowsValues);

        if (buttonClass != null) {
            if (selectedRowsValues.length) {
                $(buttonClass).prop('disabled', false);
            } else {
                $(buttonClass).prop('disabled', true);
            }
        }
    }

    $('#table_list').bootstrapTable({
        onCheck: function(row) {
            updateUserStatus("#table_list", '#update-status');
        },
        onUncheck: function(row) {
            updateUserStatus("#table_list", '#update-status');
        },
        onCheckAll: function(rows) {
            updateUserStatus("#table_list", '#update-status');
        },
        onUncheckAll: function(rows) {
            updateUserStatus("#table_list", '#update-status');
        }
    });
    $("#update-status").on('click', function(e) {
        Swal.fire({
            title: window.trans["Are you sure"],
            text: window.trans["Change Status For Selected Users"],
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: window.trans["Yes, Change it"],
            cancelButtonText: window.trans["Cancel"]
        }).then((result) => {
            if (result.isConfirmed) {
                let url = baseUrl + '/students/change-status-bulk';
                let data = new FormData();
                data.append("ids", userIds)

                function successCallback(response) {
                    $('#table_list').bootstrapTable('refresh');
                    $('#update-status').prop('disabled', true);
                    userIds = null;
                    showSuccessToast(response.message);
                }

                function errorCallback(response) {
                    showErrorToast(response.message);
                }

                ajaxRequest('POST', url, data, null, successCallback, errorCallback);
            }
        })
    })
</script>
@endsection