@extends('layouts.master')

@section('title')
{{ __('receive_payment') }}
@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{ __('manage') . ' ' . __('subscription') }}
        </h3>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 text-right">
                        <a href="{{ url('subscriptions/report') }}" class="btn btn-sm btn-theme">{{ __('back') }}</a>
                    </div>

                    <form method="POST" action="{{ route('subscriptions-bill-payment.update', $subscriptionBill->id) }}" class="edit-form" novalidate="novalidate" data-success-function="formSuccessFunction">
                        @csrf
                        <div class="border border-secondary rounded-lg my-4 mx-1">
                            <div class="col-md-12 mt-3">
                                <h4>{{ __('subscription') . ' ' . __('bill') }} {{ __('receive_payment') }}</h4>
                            </div>
                            <div class="col-12 mb-3">
                                <hr class="mt-0">
                            </div>
                            <div class="row my-4 mx-1">
                                <div class="form-group col-md-6 col-sm-12">
                                    <h4>{{ $subscriptionBill->school->name }} <span class="text-info">#{{ $subscriptionBill->subscription->name }}</span></h4>
                                </div>

                                <div class="form-group col-md-6 col-sm-12 text-right">
                                    <span class="billing_cycle btn-gradient-dark p-2">{{ date('F j, Y', strtotime($subscriptionBill->subscription->start_date)) }} - {{ date('F j, Y', strtotime($subscriptionBill->subscription->end_date)) }}</span>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <table class="table table-bordered">
                                    <!-- Table Content Here... (unchanged from your original code) -->
                                </table>
                            </div>

                            <input type="hidden" name="school_id" value="{{ $subscriptionBill->school_id }}">
                            <input type="hidden" name="amount" value="{{ number_format(ceil(($subscriptionBill->amount) * 100) / 100, 2) }}">

                            <div class="form-group col-sm-12 col-md-12 mt-4">
                                <label>{{ __('payment_type') }} <span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    @if ($subscriptionBill->transaction && $subscriptionBill->transaction->payment_gateway == 'Cash')
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="subscription_transaction[payment_gateway]" value="Cash" class="form-check-input payment_type cash" checked>
                                        <label class="form-check-label">{{ __('cash') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="subscription_transaction[payment_gateway]" value="Cheque" class="form-check-input payment_type cheque">
                                        <label class="form-check-label">{{ __('cheque') }}</label>
                                    </div>
                                    @else
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="subscription_transaction[payment_gateway]" value="Cash" class="form-check-input payment_type cash">
                                        <label class="form-check-label">{{ __('cash') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="subscription_transaction[payment_gateway]" value="Cheque" class="form-check-input payment_type cheque" checked>
                                        <label class="form-check-label">{{ __('cheque') }}</label>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-sm-12 col-md-4 cheque_input">
                                <label for="cheque_number">{{ __('cheque_no') }} <span class="text-danger">*</span></label>
                                <input type="text" name="cheque_number" value="{{ $subscriptionBill->transaction ? $subscriptionBill->transaction->order_id : '' }}" required class="form-control" placeholder="{{ __('enter_cheque_number') }}">
                            </div>
                        </div>

                        <input class="btn btn-theme" type="submit" value="{{ __('submit') }}">
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script>
    setTimeout(() => {
        window.onload = $('.payment_type').trigger('change');
    }, 500);
    $('.payment_type').change(function(e) {
        e.preventDefault();
        if ($("input[type='radio'].cash:checked").val() == 'Cash') {
            $('.cheque_input').slideUp(500);
        } else {
            $('.cheque_input').slideDown(500);
        }
    });

    function formSuccessFunction(response) {
        setTimeout(() => {
            window.location.href = "{{url('subscriptions/report')}}"
        }, 2000);
    }
</script>
@endsection