@extends('layouts.master')

@section('title')
{{ __('manage').' '.__('role') }}
@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{ __('manage').' '.__('role') }}
        </h3>
    </div>
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-theme" href="{{ route('roles.index') }}">{{ __('back') }}</a>
                    </div>
                    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="edit-form-without-reset">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label><strong> {{ __('name') }}:</strong></label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ __('name') }}" {{ $role->name == "Teacher" ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    @foreach ($permission as $value)
                                    <div class="form-group col-lg-3 col-sm-12 col-xs-12 col-md-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), ['class' => 'name form-check-input']) }}
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input class="btn btn-theme float-right ml-3" id="create-btn" type="submit" value={{ __('submit') }}>
                                <input class="btn btn-secondary float-right" type="reset" value={{ __('reset') }}>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection