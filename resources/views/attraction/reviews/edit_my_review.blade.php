<?php
$readonly = false;
?>

@extends('templates.default')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Edit my review</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="container content">
            <div class="row">
                <div class="col-lg-12">

                    <div class="cipanel">

                        <div class="cipanel-title">
                            <div class="cipanel-tools">

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

                                    {!! Form::model($result, ['method' => 'POST', 'url' => '/attractions/reviews/edit-my-review?user_id='.$user->id.'&attraction_id='.$attraction_id]) !!}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group <?php if($errors->has('email_id')){ echo "has-error";} ?>">
                                                {!! Form::label('email_id', 'Email') !!}
                                                {!! Form::text('email_id',$result->user->email,['class'=>'form-control', 'readonly']) !!}
                                            </div>
                                        </div> <div class="col-md-6">
                                            <div class="form-group <?php if($errors->has('name')){ echo "has-error";} ?>">
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