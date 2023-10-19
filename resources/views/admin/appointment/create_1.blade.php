@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.appointment.create") }}" method="GET" enctype="multipart/form-data">
            @csrf




            <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('date_available') ? 'has-error' : '' }}">
                        <label for="date_available">{{ trans('cruds.appointment.fields.date_available') }}*</label>
                      <input type="date" name="fecha" id="">
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


                <a class="btn btn-success" href="{{ route("admin.appointment.create") }}">
                <button type="submit" class="btn btn-success">filtrar</button>
            </a>  





      
        </form>
    </div>


</div>
@endsection


