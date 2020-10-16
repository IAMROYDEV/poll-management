@extends('layouts.app')

@section('template_title')
    {!! trans('pollsmanagement.showing-all-polls') !!}
@endsection

@section('template_linked_css')
    @if(config('pollsmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('pollsmanagement.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .polls-table {
            border: 0;
        }
        .polls-table tr td:first-child {
            padding-left: 15px;
        }
        .polls-table tr td:last-child {
            padding-right: 15px;
        }
        .polls-table.table-responsive,
        .polls-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('pollsmanagement.showing-all-polls') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-sm btn-info btn-block" href="/polls/create" data-toggle="tooltip" title="Create">
                                    {!! trans('pollsmanagement.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('pollsmanagement.enableSearchPolls'))
                            @include('partials.search-polls-form')
                        @endif

                        <div class="table-responsive polls-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="poll_count">
                                    {{ trans_choice('pollsmanagement.polls-table.caption', 1, ['pollscount' => $polls->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>{!! trans('pollsmanagement.polls-table.id') !!}</th>
                                        <th>{!! trans('pollsmanagement.polls-table.name') !!}</th>
                                        <th class="hidden-xs">{!! trans('pollsmanagement.polls-table.description') !!}</th>
                                        <th class="hidden-xs">{!! trans('pollsmanagement.polls-table.activated') !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('pollsmanagement.polls-table.created') !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('pollsmanagement.polls-table.updated') !!}</th>
                                        <th>{!! trans('pollsmanagement.polls-table.actions') !!}</th>
                                        <th class="no-search no-sort"></th>
                                        <th class="no-search no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody id="polls_table">
                                    @foreach($polls as $poll)
                                        <tr>
                                            <td>{{$poll->id}}</td>
                                            <td>{{$poll->name}}</td>
                                            <td>{{$poll->description}}</td>
                                            <td>{{$poll->activated}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$poll->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$poll->updated_at}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'polls/' . $poll->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('pollsmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Poll', 'data-message' => 'Are you sure you want to delete this poll ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('polls/' . $poll->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    {!! trans('pollsmanagement.buttons.edit') !!}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('pollsmanagement.enableSearchPolls'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('pollsmanagement.enablePagination'))
                                {{ $polls->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($polls) > config('pollsmanagement.datatablesJsStartCount')) && config('pollsmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('pollsmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('pollsmanagement.enableSearchPolls'))
        @include('scripts.search-polls')
    @endif
@endsection
