

@extends('templates.default')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Top 5 Attractions</h2>
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

                            <?php if(count($average)): ?>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Score
                                                </th>

                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($results as $result)

                                                <tr>

                                                    <td>{{ $result->name }}</td>
                                                    <td>{{ $average[$result->id] }}</td>

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