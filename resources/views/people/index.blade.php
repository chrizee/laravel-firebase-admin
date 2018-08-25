@extends("layouts.app2")

@section("content")
    <section class="col-lg-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(count($users) > 0)
                    <div class="table">
                        <table  class="table table-bordered table-hover table-striped datatable">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date of Birth</th>
                                    <th>Date subscribed</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ ($key + 1) }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->date_of_birth->toFormattedDateString() }}</td>
                                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text text-center text-info">No user.</p>
                @endif

            </div>
            <!-- /.box-body -->
        </div>

    </section>
@endsection