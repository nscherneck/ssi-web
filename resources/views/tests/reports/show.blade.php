@extends('layout')

@section('title', 'SSI-Web | Test Report')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container-fluid">

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="/customer/{{ $test->system->site->customer->id }}">{{ $test->system->site->customer->name }}</a></li>
    <li><a href="/site/{{ $test->system->site->id }}">{{ $test->system->site->name }}</a></li>
    <li><a href="/system/{{ $test->system->id }}">{{ $test->system->name }}</a></li>
    <li><a href="/tests/{{ $test->id }}">{{ $test->test_type->name }} - {{ $test->test_date->format('F d, Y') }}</a></li>
    <li>Report</li>
  </ol>

</div>

<!--          CONTENT         -->

<div class="container-fluid text-center">

<embed src="https://s3-us-west-2.amazonaws.com/ssiwebstorage/{{ $document->path }}" width="800px" height="1000" />
<br><br>

</div>

@stop
