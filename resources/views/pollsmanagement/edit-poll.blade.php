@extends('layouts.app')

@section('template_title')
    {!! trans('pollsmanagement.editing-poll', ['name' => $poll->name]) !!}
@endsection

@section('template_linked_css')
    <style type="text/css">
        .btn-save,
        .pw-change-container {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('pollsmanagement.editing-poll', ['name' => $poll->name]) !!}
                            <div class="pull-right">
                                <a href="{{ route('polls') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('pollsmanagement.tooltips.back-polls') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('pollsmanagement.buttons.back-to-polls') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['polls.update', $poll->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                {!! Form::label('name', trans('pollforms.create_poll_label_name'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('name', $poll->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('pollforms.create_poll_ph_pollname'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                <i class="fa fa-fw {{ trans('pollforms.create_poll_icon_name') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                                {!! Form::label('first_name', trans('pollforms.create_poll_label_description'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('description', $poll->description, array('id' => 'description', 'class' => 'form-control', 'placeholder' => trans('pollforms.create_poll_ph_description'))) !!}

                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                                {!! Form::label('first_name', trans('pollforms.create_poll_label_activate'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        @if ($poll->activated)
                                            {!! Form::checkbox('activated', NULL, array('id' => 'activate', 'class' => 'form-control', 'placeholder' => trans('pollforms.create_poll_ph_activate'))) !!}
                                        @else
                                            {{ Form::checkbox('activated') }}
                                        @endif

                                    </div>
                                    @if ($errors->has('activated'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('activated') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            {!! Form::button(trans('pollforms.create_poll_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')
@endsection
