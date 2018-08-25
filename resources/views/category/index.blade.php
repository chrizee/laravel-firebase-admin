@extends("layouts.app2")

@section("content")
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <button class="btn btn-sm btn-default new"><i class="fa fa-plus"></i> New</button>
    </div>
    <section class="col-lg-6 connectedSortable">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Categories</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(count($categories) > 0)
                    <table class="text-center table table-condensed">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>No of Clothing</th>
                        </tr>
                        @foreach($categories as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ route("categories.show", $value->key) }}">{{ $value->name }}</a></td>
                                    <td><span class="badge bg-info">{{ $value->no_of_clothing }}</span></td>
                                </tr>
                        @endforeach
                    </table>
                @else
                    <p class="text text-center text-info">No category.</p>
                @endif

            </div>
            <!-- /.box-body -->
        </div>

    </section>

    <section class="col-lg-6 connectedSortable new-category hidden">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Add category</h3>
            </div>

            <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}" >
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<script type="text/javascript">
    $(document).ready(function() {
        $("body").on("click", "button.new", function() {
            $("section.new-category").toggleClass("hidden");
        })
    })
</script>
@endsection