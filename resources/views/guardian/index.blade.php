@extends('layouts.master')

@section('title')
    {{ __('Guardian') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('Guardian') }}
            </h3>
        </div>

        <div class="row">
            {{--            <div class="col-lg-12 grid-margin stretch-card">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <h4 class="card-title">--}}
            {{--                            {{ __('create').' '.__('Guardian') }}--}}
            {{--                        </h4>--}}
            {{--                        <form class="create-form pt-3 create-guardian-form" id="formdata" action="{{route('guardian.store')}}" enctype="multipart/form-data" method="POST" novalidate="novalidate">--}}
            {{--                            @csrf--}}
            {{--                            <div class="row">--}}
            {{--                                <div class="form-group col-sm-12 col-md-6">--}}
            {{--                                    <label>{{ __('first_name') }} <span class="text-danger">*</span></label>--}}
            {{--                                    <input type="text" name="first_name" class="form-control" placeholder="{{ __('first_name') }}" required> --}}

            {{--                                </div>--}}
            {{--                                <div class="form-group col-sm-12 col-md-6">--}}
            {{--                                    <label>{{ __('last_name') }} <span class="text-danger">*</span></label>--}}
            {{--                                    <input type="text" name="last_name" class="form-control" placeholder="{{ __('last_name') }}" required>
            {{--                                </div>--}}

            {{--                                <div class="form-group col-sm-12 col-md-6">--}}
            {{--                                    <label>{{ __('email') }} <span class="text-danger">*</span></label>--}}
            {{--                                    <input type="text" name="email" class="form-control" placeholder="{{ __('email') }}" required>

            {{--                                </div>--}}


            {{--                                <div class="form-group col-sm-12 col-md-6">--}}
            {{--                                    <label>{{ __('mobile') }} <span class="text-danger">*</span></label>--}}
            {{--                                    <input type="number" name="mobile" class="form-control" placeholder="{{ __('mobile') }}" required>                --}}
            {{--                                </div>--}}
            {{--                                <div class="form-group col-sm-12 col-md-3">--}}
            {{--                                    <label>{{ __('gender') }} <span class="text-danger">*</span></label><br>--}}
            {{--                                    <div class="d-flex">--}}
            {{--                                        <div class="form-check form-check-inline">--}}
            {{--                                            <label class="form-check-label">--}}
            {{--                                                <input type="radio" name="gender" value="male" class="form-check-input" checked>                --}}
            {{--                                                {{ __('male') }}--}}
            {{--                                            </label>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="form-check form-check-inline">--}}
            {{--                                            <label class="form-check-label">--}}
            {{--                                              <input type="radio" name="gender" value="female" class="form-check-input">                --}}
            {{--                                                {{ __('female') }}--}}
            {{--                                            </label>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}

            {{--                            </div>--}}
            {{--                            <input class="btn btn-theme" type="submit" value={{ __('submit') }}>--}}
            {{--                        </form>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ __('list') . ' ' . __('Guardian') }}
                        </h4>
                        <div class="row">
                            <div class="col-12">
                                <table aria-describedby="mydesc" class='table' id='table_list' data-toggle="table"
                                       data-url="{{ route('guardian.show',1) }}" data-click-to-select="true"
                                       data-side-pagination="server" data-pagination="true" data-toolbar="#toolbar"
                                       data-show-columns="true" data-show-refresh="true" data-search="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id"
                                       data-sort-order="desc" data-maintain-selected="true" data-export-data-type='all' data-show-export="true"
                                       data-export-options='{ "fileName": "guardian-list-<?= date('d-m-y') ?>" ,"ignoreColumn": ["operate"]}'
                                       data-query-params="queryParams" data-escape="true">
                                    <thead>
                                    <tr>
                                        <th scope="col" data-sortable="true" data-visible="false" data-align="center" data-field="id"> {{ __('id') }}</th>
                                        <th scope="col" data-align="center" data-field="no"> {{ __('no.') }} </th>
                                        <th scope="col" data-align="center" data-field="first_name"> {{ __('first_name') }} </th>
                                        <th scope="col" data-align="center" data-field="last_name"> {{ __('last_name') }} </th>
                                        <th scope="col" data-align="center" data-field="gender"> {{ __('gender') }} </th>
                                        <th scope="col" data-align="center" data-field="email"> {{ __('email') }} </th>
                                        <th scope="col" data-align="center" data-field="mobile"> {{ __('mobile') }} </th>
                                        <th scope="col" data-align="center" data-field="image" data-formatter="imageFormatter"> {{ __('image') }} </th>
                                        <th data-events="guardianEvents" scope="col" data-field="operate" data-escape="false"> {{ __('action') }} </th>
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

    <div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('edit') . ' ' . __('Guardian') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                    </button>
                </div>
                <form id="edit-form" novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label>{{ __('first_name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="{{ __('first_name') }}" required>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label>{{ __('last_name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="{{ __('last_name') }}" required>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label>{{ __('email') }} <span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="{{ __('email') }}" required>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label>{{ __('mobile') }} <span class="text-danger">*</span></label>
                                <input type="number" name="mobile" id="mobile" class="form-control" placeholder="{{ __('mobile') }}" min="0" required>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>{{ __('gender') }} <span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" name="gender" value="male" class="form-check-input edit" id="male">
                                            {{ __('male') }}
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" name="gender" value="female" class="form-check-input edit" id="female">
                                            {{ __('female') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                <label for="image">{{ __('image') }} </label>
                                <input type="file" name="image" class="file-upload-default"/>
                                <div class="input-group col-xs-12">
                                    <input type="text" id="image" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}"/>
                                    <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                        </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-4">
                                <div class="d-flex">
                                    <div class="form-check w-fit-content">
                                        <label class="form-check-label ml-4">
                                            <input type="checkbox" class="form-check-input" name="reset_password" value="1">{{ __('reset_password') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <input class="btn btn-theme" type="submit" value={{ __('submit') }}>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
