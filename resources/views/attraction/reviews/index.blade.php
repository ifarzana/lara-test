@extends('templates.default')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Reviews of {{ $attraction->name }} </h2>

        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="container content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cipanel">

                        <div class="cipanel-title">
                            <div class="cipanel-tools">

                                <a href=""
                                   class="btn btn-primary btn-xs">Reset all filters</a>
                            </div>
                        </div>
                        <div class="cipanel-content">

                            <?php if(count($results)): ?>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    User
                                                </th>
                                                <th>
                                                    Rating
                                                </th>

                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($results as $result)

                                                <tr>

                                                    <td>{{ $result->user->email }}</td>
                                                    <td>{{ $result->rating }}</td>

                                                    <td class="td-two text-right">
                                                        <?php if(AclManagerHelper::hasPermission('editReview')): ?>
                                                        <a class="btn btn-xs btn-outline btn-warning"
                                                           href="/attractions/reviews/edit?reviews_id=<?php echo $result->id?>">
                                                            Edit
                                                        </a>
                                                        <?php endif; ?>

                                                        @if($result->isHidden == true)
                                                            <a class="btn btn-xs btn-success permission-button" href="/attractions/reviews/change-status?attraction_id=<?php echo $result->attraction->id?>&reviews_id=<?php echo $result->id?>"><span class="fa fa-check-circle"></span> Show</a>
                                                        @else
                                                            <a class="btn btn-xs btn-danger permission-button" href="/attractions/reviews/change-status?attraction_id=<?php echo $result->attraction->id?>&reviews_id=<?php echo $result->id?>"><span class="fa fa-minus-circle"></span> Hide</a>
                                                        @endif

                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <h4 class="text-center text-danger" style="padding-top: 15px;">No results found</h4>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection