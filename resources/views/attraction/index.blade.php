

@extends('templates.default')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Attractions</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="container content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cipanel">

                        <div class="cipanel-title">
                            <div class="cipanel-tools">

                                <a href="/attractions/top-attractions"
                                   class="btn btn-primary btn-xs">Top 5 attractions</a>

                                <?php if(AclManagerHelper::hasPermission('create')): ?>
                                    <a href="/attractions/create"
                                       class="btn btn-primary btn-xs">New attraction</a>
                                <?php endif; ?>

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
                                                    Name
                                                </th>

                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($results as $result)

                                                <?php

                                                /*If user - only one review*/
                                                $userReview = null;
                                                if($user->group->locked != 1){
                                                    /*Check if review exists*/
                                                    $userReview = \App\Models\Attraction\AttractionReview::where('user_id', $user->id)->where('attraction_id', $result->id)->get();
                                                }
                                                ?>

                                                <tr>

                                                    <td>{{ $result->name }}</td>


                                                    <td class="td-four text-right">

                                                        <?php

                                                        if(count($userReview) < 1): ?>
                                                            <?php if(AclManagerHelper::hasPermission('read')): ?>
                                                                <a class="btn btn-xs btn-outline btn-warning"
                                                                   href="attractions/reviews/create?attraction_id=<?php echo $result->id; ?>">
                                                                    Add review
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if($user->group->locked !=1): ?>
                                                                <?php if(AclManagerHelper::hasPermission('editReview')): ?>
                                                                <a class="btn btn-xs btn-outline btn-warning"
                                                                   href="/attractions/reviews/edit-my-review?user_id=<?php echo $user->id?>&attraction_id=<?php echo $result->id?>">
                                                                    Edit my review
                                                                </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <?php if($user->group->locked): ?>
                                                            <?php if(AclManagerHelper::hasPermission('read')): ?>
                                                                <a class="btn btn-xs btn-outline btn-warning"
                                                                   href="attractions/reviews?attraction_id=<?php echo $result->id; ?>">
                                                                    Reviews
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <?php if(AclManagerHelper::hasPermission('update')): ?>
                                                            <a class="btn btn-xs btn-outline btn-warning"
                                                               href="attractions/edit?id=<?php echo $result->id; ?>">
                                                                Edit
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if(AclManagerHelper::hasPermission('delete')): ?>
                                                            <a class="btn btn-xs btn-outline btn-danger"
                                                               href="javascript:confirmation('attractions/delete?id=<?php echo $result->id; ?>', 'Delete attraction ?')">
                                                                Delete
                                                            </a>
                                                        <?php endif; ?>

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