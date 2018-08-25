@extends("layouts.app2")

@section("content")
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <button class="btn btn-sm btn-default edit"><i class="fa fa-edit"></i> Edit</button>
        <form class="form-horizontal"  style="display: inline-block;" method="post" action="{{ route("clothing.destroy", $clothing->key) }}">
            {{ csrf_field() }}
            {{ method_field("DELETE") }}
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
        </form>
    </div>
    <section class="col-lg-6 show-clothing connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ $clothing->name }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if($clothing)
                    @include("clothing.template")
                @else

                @endif

            </div>
            <!-- /.box-body -->
        </div>

    </section>

    <section class="@if(!$errors->any()) hidden @endif col-lg-6 connectedSortable edit-clothing ">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Edit {{  $clothing->name }}</h3>
            </div>

            <form class="" method="POST" action="{{ route('clothing.update', $clothing->key) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field("PUT") }}
                <div class="box-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Name</label>

                        <div class="">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $clothing->name }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <label for="category" class="control-label">Category</label>

                        <div class="">
                            <select class="form-control" name="category" id="category">
                                @foreach($categories as $value)
                                    <option value="{{ $value->key }}" @if($value->key == $clothing->category_key) selected="selected" @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                        <label for="picture" class="control-label">Picture</label>

                        <div class="">
                            <input id="picture" type="file" class="form-control" name="picture">

                            @if ($errors->has('picture'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('picture') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("click", "button.edit", function() {
                $("section.edit-clothing").toggleClass("hidden");
            })
        })
    </script>
@endsection