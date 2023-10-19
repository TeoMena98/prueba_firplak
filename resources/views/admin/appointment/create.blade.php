@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.appointment.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

            <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('date_available') ? 'has-error' : '' }}">
                        <label for="date_available">{{ trans('cruds.appointment.fields.date_available') }}*</label>
                        <select name="date_available" id="date_available" class="form-control select2" required>
                            <option value="">Seleccionar Fecha</option>
                            @foreach($events_time as $id => $events_time)
                            <option value="{{  $events_time->Fecha }}">{{ $events_time->Fecha }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('date_available'))
                        <em class="invalid-feedback">
                            {{ $errors->first('date_available') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.appointment.fields.email_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('time_available') ? 'has-error' : '' }}">
                        <label for="time_available">{{ trans('cruds.appointment.fields.time_available') }}*</label>
                        <select name="time_available" id="time_available" class="form-control select2" required>
                            <option value="">Seleccionar Hora</option>
                            @foreach($events_hour as $id => $events_hour)
                            <option value="{{  $events_hour ->Hora_inicial}}">{{ $events_hour ->Hora_inicial}}-{{ $events_hour ->Hora_final}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('time_available'))
                        <em class="invalid-feedback">
                            {{ $errors->first('time_available') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.appointment.fields.email_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <input id="student_id" name="student_id" type="hidden" value="{{Auth()->id()}}">
                    <div class="form-group {{ $errors->has('university') ? 'has-error' : '' }}">
                        <label for="university">{{ trans('cruds.appointment.fields.university') }}*</label>
                        <select name="university_id" id="university_id" class="form-control select2" required>
                            <option value="">Seleccionar Universidad</option>
                            @foreach($universities as $id => $universities)
                            <option value="{{ $id }}" {{ (in_array($id, old('universities', [])) || isset($user) && $user->universities->contains($id)) ? 'selected' : '' }}>{{ $universities }}</option>
                            @endforeach
                        </select> @if($errors->has('university'))
                        <em class="invalid-feedback">
                            {{ $errors->first('university') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.appointment.fields.name_helper') }}
                        </p>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('career') ? 'has-error' : '' }}">
                        <label for="career">{{ trans('cruds.appointment.fields.career') }}*</label>

                        <select name="career_id" id="career_id" class="form-control select2" required>
                            <option value="">Seleccionar Carrera</option>
                            @foreach($careers as $id => $careers)
                            <option value="{{ $id }}" {{ (in_array($id, old('careers', [])) || isset($user) && $user->careers->contains($id)) ? 'selected' : '' }}>{{ $careers }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('career'))
                        <em class="invalid-feedback">
                            {{ $errors->first('career') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.appointment.fields.email_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
                        <label for="course">{{ trans('cruds.appointment.fields.course') }}*</label>
                        <select name="course_id" id="course_id" class="form-control select2" required>
                            <option value="">Seleccionar Materia</option>
                            @foreach($courses as $id => $courses)
                            <option value="{{ $id }}" {{ (in_array($id, old('courses', [])) || isset($user) && $user->courses->contains($id)) ? 'selected' : '' }}>{{ $courses }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('course'))
                        <em class="invalid-feedback">
                            {{ $errors->first('course') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.appointment.fields.password_helper') }}
                        </p>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('tutor') ? 'has-error' : '' }}">
                        <label for="tutor">{{ trans('cruds.appointment.fields.tutor') }}*</label>
                        <select name="tutor_id" id="tutor_id" class="form-control select2" required>
                            <option value="">Seleccionar Tutor</option>
                            @foreach($user_roles as $id => $user_roles)
                            <option value="{{$user_roles->id}}"> {{$user_roles->name}}</option>
                            @endforeach
                        </select> @if($errors->has('tutor'))
                        <em class="invalid-feedback">
                            {{ $errors->first('tutor') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.appointment.fields.email_helper') }}
                        </p>
                    </div>
                </div>
                




                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </div>
        </form>
    </div>


</div>
@endsection


@section('scripts')

<script>
    $(function() {
        const $tutor_id = $('#tutor_id');
        $date_available = $('date_available');

        $tutor_id.change(() => {
            const tutorId = $tutor_id.val();
            const url = `/admin/users/${tutorId}`;
            console.log(url);
            $.getJSON(url, onDoctorsLoaded)
        });

        // $doctor.change(loadHours);
        // $date.change(loadHours);
    });



    function onDoctorsLoaded(events_time) {
        let htmlOptions = '';
        events_time.forEach(doctor => {
            htmlOptions += `<option value="${events_time.Fecha}">${doctor.Fecha}</option>`;
        });
        $doctor.html(htmlOptions);

    }
</script>

@endsection