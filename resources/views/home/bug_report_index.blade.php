@extends('layouts.app')

@section('title') Support Center @endsection

@section('content')
    <!--{!! breadcrumbs(['Reports' => 'reports']) !!}-->
<h1>
Support Center
</h1>
<h4>Ask questions, submit suggestions, and report bugs</h4>
<br>
<!--<p>Please check the current 'fix in progress' reports to ensure your ticket is not already being worked on! If the title is not descriptive enough, or does not match your issue, feel free to create a new one.</p>
<div class="alert alert-warning">Please note that certain tickets cannot be viewed until they are closed to prevent abuse.</div>-->
<br>
@if(Auth::check())
    <div class="text-center">
            <a href="{{ url('reports/new') }}" class="btn btn-success">New Report</a>
    </div>
@endif
<br>
@if(Auth::check() && Auth::user()->isStaff)
{!! Form::open(['method' => 'GET', 'class' => 'form-inline justify-content-end']) !!}
        <div class="form-group mr-3 mb-3">
            {!! Form::text('url', Request::get('url'), ['class' => 'form-control', 'placeholder' => 'URL / Title']) !!}
        </div>
        <div class="form-group mb-3">
            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
        </div>
@endif
    {!! Form::close() !!}

@if(Auth::check() && Auth::user()->isStaff)
@if(count($reports))
    {!! $reports->render() !!}
    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-6 col-md-4"><div class="logs-table-cell">Link/Title</div></div>
                <div class="col-6 col-md-5"><div class="logs-table-cell">Submitted</div></div>
                <div class="col-12 col-md-1"><div class="logs-table-cell">Status</div></div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach($reports as $report)
                <div class="logs-table-row">
                    @include('home._report', ['report' => $report])
                </div>
            @endforeach
        </div>
    </div>
    {!! $reports->render() !!}
    <div class="text-center mt-4 small text-muted">{{ $reports->total() }} result{{ $reports->total() == 1 ? '' : 's' }} found.</div>
@else 
    <p>No reports found.</p>
@endif
@endif

@endsection
