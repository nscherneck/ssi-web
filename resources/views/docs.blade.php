@extends('layout')

@section('title', 'SSI-Extranet | Docs & Resources')

@section('content')

@include('partials.nav')

<div class="container-fluid">

    <br>
    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addDocTemplateModal">
      <i class="fa fa-plus"></i></button>

    <div class="row">
      <br>

      <div class="col-md-4 no-gutter-right">

        <div class="panel panel-danger">
          <div class="panel-heading">Templates</div>

            <table class="table">

              <thead>
                <tr>
                  <th><small>File</small></th>
                  <th><small>Description</small></th>
                </tr>
              </thead>
              <tbody>
                <tr>

                </tr>
              </tbody>

            </table>

            <div class="panel-footer">

            </div>

        </div> <!-- END OF PANEL -->

      </div>

      <div class="col-md-4 no-gutter-right">

        <div class="panel panel-danger">
          <div class="panel-heading">Codes & Standards</div>

            <table class="table">

              <thead>
                <tr>
                  <th><small>File</small></th>
                  <th><small>Description</small></th>
                </tr>
              </thead>
              <tbody>
                <tr>

                </tr>
              </tbody>

            </table>

            <div class="panel-footer">

            </div>

        </div> <!-- END OF PANEL -->

      </div>

      <div class="col-md-4">

        <div class="panel panel-danger">
          <div class="panel-heading">Other</div>

            <table class="table">

              <thead>
                <tr>
                  <th><small>File</small></th>
                  <th><small>Description</small></th>
                </tr>
              </thead>
              <tbody>
                <tr>

                </tr>
              </tbody>

            </table>

            <div class="panel-footer">

            </div>

        </div> <!-- END OF PANEL -->

      </div>

    </div>

</div>

@stop
