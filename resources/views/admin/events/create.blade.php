@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.events.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.event.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($event) ? $event->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.name_helper') }}
                </p>
            </div>
      
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.event.fields.start_time') }}*</label>
                <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($event) ? $event->start_time : '') }}" required>
                @if($errors->has('start_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.start_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                <label for="end_time">{{ trans('cruds.event.fields.end_time') }}*</label>
                <input type="text" id="end_time" name="end_time" class="form-control datetime" value="{{ old('end_time', isset($event) ? $event->end_time : '') }}" required>
                @if($errors->has('end_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.end_time_helper') }}
                </p>
            </div>

            <!-- @can('user_management_access') -->
            <div class="form-group {{ $errors->has('tutor') ? 'has-error' : '' }}">
                        <label for="tutor">{{ trans('cruds.appointment.fields.tutor') }}*</label>
                        <select name="tutor_id" id="" class="form-control select2" >
                    @foreach($user_roles as $id => $user_roles)
                        <option value="{{$user_roles->id}}" > {{$user_roles->name}}</option>
                    @endforeach
             
                    </div>

        

            <!-- @endcan -->

           <!-- <input type="text"  style="display:none;" name="" value="{{auth()->user()->id}}" id=""> -->
            <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
                        <label for="course">{{ trans('cruds.appointment.fields.course') }}*</label>
                        <select name="course_id" id="course_id" class="form-control select2" required>
                    @foreach($materias as $id => $user_roles)
                        <option value="{{$user_roles->id}}" > {{$user_roles->title}}</option>
                    @endforeach
                </select>                         @if($errors->has('materia'))
                        <em class="invalid-feedback">
                            {{ $errors->first('materia') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.appointment.fields.email_helper') }}
                        </p>
                    </div>

            <div class="form-group {{ $errors->has('recurrence') ? 'has-error' : '' }}">
                <label>{{ trans('cruds.event.fields.recurrence') }}*</label>
                @foreach(App\Event::RECURRENCE_RADIO as $key => $label)
                    <div>
                        <input id="recurrence_{{ $key }}" name="recurrence" type="radio" value="{{ $key }}" {{ old('recurrence', 'none') === (string)$key ? 'checked' : '' }} required>
                        <label for="recurrence_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('recurrence'))
                    <em class="invalid-feedback">
                        {{ $errors->first('recurrence') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection