<?php
$readonly = false;
?>

@extends('templates.default')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>New attraction</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="container content">
            <div class="row">
                <div class="col-lg-12">

                    <div class="cipanel">

                        <div class="cipanel-title">
                            <div class="cipanel-tools">
                                <a class="btn btn-primary btn-xs panel-back tip-bottom" data-placement="bottom" data-toggle="tooltip"
                                   data-original-title="Back" href="">
                                    <span class="fa fa-arrow-left"></span>
                                </a>
                            </div>
                        </div>


                        <div class="cipanel-content">

                            @if (isset($errors) && count($errors) > 0)
                                <div class="alert alert-danger alert-list" role="alert">
                                    <p>There were one or more issues with your submission. Please correct them as indicated below.</p>

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>

                                </div>
                            @endif



                            <div class="row">
                                <div class="col-md-12">

                                    {!! Form::open(['method' => 'POST', 'url' => '/attractions/create']) !!}

                                    {!! Form::hidden('id', null) !!}

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group <?php if($errors->has('name')){ echo "has-error";} ?>">
                                                {!! Form::label('name', 'Name') !!}
                                                {!! Form::text('name',null,['class'=>'form-control', 'required', $readonly]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 text-right">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>

                                    {!! Form::close() !!}

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection