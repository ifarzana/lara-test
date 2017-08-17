<?php
$readonly = false;
?>

@extends('templates.default')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>New attraction review</h2>
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

                                    {!! Form::open(['method' => 'POST', 'url' => '/attractions/reviews/create']) !!}

                                    {!! Form::hidden('user_id', $user->id) !!}
                                    {!! Form::hidden('attraction_id', $attraction_id) !!}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group <?php if($errors->has('user_id')){ echo "has-error";} ?>">
                                                {!! Form::label('user_id', 'User') !!}
                                                {!! Form::text('email',$user->email,['class'=>'form-control', 'required', 'readonly']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group <?php if($errors->has('rating')){ echo "has-error";} ?>">
                                                {!! Form::label('rating', 'Rating') !!}
                                                {!! Form::number('rating',null,['class'=>'form-control', 'max' => 5, 'min' => 1, 'required', $readonly]) !!}
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