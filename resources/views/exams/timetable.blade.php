@extends('layouts.master')

@section('title')
    {{ __('manage') . ' ' . __('exam') . ' ' . __('timetable') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('exam') . ' ' . __('timetable') }}
            </h3>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card search-container">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-sm btn-theme" href="{{ route('exams.index') }}">{{ __('back') }}</a>
                        </div>
                        <h4 class="page-title mb-4">
                            {{ __('create') . ' ' . __('exam') . ' ' . __('timetable') }}
                        </h4>
                        <div class="form-group">
                            <form class="edit-form" data-success-function="formSuccessFunction" action="{{ route('exam.timetable.update',$exam->id) }}" data-pre-submit-function="classValidation" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{ __('exam') }} </label>
                                        <input type="hidden" name="semester_id" value="{{ old('semester_id', $exam->semester_id ?? null) }}">
                                        <input type="hidden" name="session_year_id" value="{{ old('session_year_id', $exam->session_year_id) }}">
                                        <input type="text" value="{{ $exam->name }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Class') }} </label>
                                        <input type="text" value="{{ $exam->class->full_name }}" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="exam-timetable-content">
                                    <div data-repeater-list="timetable">
                                        <div data-repeater-item>
                                            <div class="row">
                                            <input type="hidden" name="id" value="{{ old('id') }}" class="timetable_id">
                                                <div class="form-group col-md-4">
                                                    <label for="subject_id">{{ __('subject') }} </label>
                                                    <select name="class_subject_id" id="subject_id" class="form-control exam-subjects-options subject" required>
                                                        @if(!empty($exam->class->all_subjects))
                                                            <option value="">-- {{ __('select') }} --</option>
                                                            @foreach($exam->class->all_subjects as $subject)
                                                                <option value="{{$subject->class_subject_id}}">{{$subject->name_with_type}}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="">-- {{ __('no_data_found') }} --</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>{{ __('total_marks') }} <span class="text-danger">*</span></label>
                                                    <input type="text" name="total_marks" value="{{ old('total_marks') }}" class="total-marks form-control" placeholder="{{ __('total_marks') }}" min="1" required data-convert="number">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>{{ __('passing_marks') }} <span class="text-danger">*</span></label>
                                                    <input type="text" name="passing_marks" value="{{ old('passing_marks') }}" class="passing-marks form-control" placeholder="{{ __('passing_marks') }}" min="1" required data-convert="number">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label>{{ __('start_time') }} <span class="text-danger">*</span></label>
                                                    <input type="text" name="start_time" value="{{ old('start_time') }}" class="start-time form-control" placeholder="{{ __('start_time') }}" autocomplete="off" required data-convert="time">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>{{ __('end_time') }} <span class="text-danger">*</span></label>
                                                    <input type="text" name="end_time" value="{{ old('end_time') }}" class="end-time form-control" placeholder="{{ __('end_time') }}" autocomplete="off" required data-convert="time">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>{{ __('date') }} <span class="text-danger">*</span></label>
                                                    <input type="text" name="date" value="{{ old('date') }}" class="timetable-date form-control" placeholder="{{ __('date') }}" required>
                                                </div>
                                                <div class="form-group col-md-1 pl-0 mt-4" data-repeater-delete>
                                                    <button type="button" {{ $disabled }} class="btn btn-inverse-danger btn-icon remove-exam-timetable-content">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-md-4 mt-3 mb-3">
                                        <button type="button" {{ $disabled }} class="btn btn-success add-exam-timetable-content" title="Add new row" data-repeater-create>
                                            {{ __('Add New Data') }}
                                        </button>
                                    </div>
                                </div>
                                <input class="btn btn-theme float-right ml-3" id="create-btn" {{ $disabled }} type="submit" value={{ __('submit') }}>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        @if(isset($exam->timetable) && $exam->timetable->isNotEmpty())
            examTimetableRepeater.setList([
                @foreach ($exam->timetable as $timetable)
                {
                    id: "{{ $timetable->id }}",
                    class_subject_id: "{{ $timetable->class_subject_id }}",
                    total_marks: "{{ $timetable->total_marks }}",
                    passing_marks: "{{ $timetable->passing_marks }}",
                    start_time: "{{ $timetable->start_time }}",
                    end_time: "{{ $timetable->end_time }}",
                    date: moment("{{ $timetable->date }}", 'YYYY-MM-DD').format('DD-MM-YYYY')
                },
                @endforeach
            ])
        @else
            $('.add-exam-timetable-content').trigger('click')
        @endif

        $(document).ready(function () {
            @foreach ($exam->timetable as $key=>$timetable)
            $('#remove-exam-timetable-' + {{$key}}).attr('data-id', {{$timetable->id}});
            @endforeach

            $('body').on('focus', ".timetable-date", function () {
                let minDate = moment("{{ $currentSessionYear->start_date }}", 'YYYY-MM-DD').format('DD-MM-YYYY') ;
                let maxDate = moment("{{ $currentSessionYear->end_date }}", 'YYYY-MM-DD').format('DD-MM-YYYY');

                $(this).datepicker({
                    enableOnReadonly: false,
                    format: "dd-mm-yyyy",
                    todayHighlight: true,
                    startDate: minDate,
                    endDate: maxDate,
                    rtl: isRTL()
                });
            });
        });

        function formSuccessFunction(response) {
            if (!response.error) {
                setTimeout(() => {
                    window.location.href = "{{route('exams.index')}}"
                }, 1000);
            }
        }
    </script>
@endsection
