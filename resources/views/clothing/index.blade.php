@extends("layouts.app2")

@section("content")
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <button class="btn btn-sm btn-default new"><i class="fa fa-plus fa-arrow-circle-right"></i> <span>New</span></button>
    </div>
    <section class="@if($errors->any()) hidden @endif col-lg-12 show-clothing connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Clothing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                @if(count($clothings) > 0)
                    @foreach($clothings as $key => $clothing)
                        @include("clothing.template")
                    @endforeach
                @else
                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                        <a href="/clothing/1">
                            <div class="fh5co-property">
                                <figure style="height:260px;">
                                    <img src="{{ asset("/storage/clothing/dress.jpg") }}" alt="clothing" class="img-responsive">
                                </figure>
                                <div class="fh5co-property-innter" style="min-height: 132px;">
                                    <h3 class="head">Name: <a href="#">dress one</a></h3>
                                    <p>Category: <a href="#"> Dress</a></p>
                                    <div class="price-status">
                                        <span class="price">$400 </span>
                                    </div>
                                    <p class="fh5co-property-specification">
                                        <span class="label label-primary"><strong>Created</strong> 28/05/2004</span>  <span class="label label-success"><strong>3</strong> Likes</span>  <span class="label label-info"><strong>3.5</strong> Comments</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                        <a href="/clothing/1">
                            <div class="fh5co-property">
                                <figure style="height:260px;">
                                    <img src="{{ asset("/storage/clothing/dress.jpg") }}" alt="clothing" class="img-responsive">
                                </figure>
                                <div class="fh5co-property-innter" style="min-height: 132px;">
                                    <h3 class="head">Name: <a href="#">dress one</a></h3>
                                    <p>Category: <a href="#"> Dress</a></p>
                                    <div class="price-status">
                                        <span class="price">$400 </span>
                                    </div>
                                    <p class="fh5co-property-specification">
                                        <span class="label label-primary"><strong>Created</strong> 28/05/2004</span>  <span class="label label-success"><strong>3</strong> Likes</span>  <span class="label label-info"><strong>3.5</strong> Comments</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                        <a href="/clothing/1">
                            <div class="fh5co-property">
                                <figure style="height:260px;">
                                    <img src="{{ asset("/storage/clothing/dress.jpg") }}" alt="clothing" class="img-responsive">
                                </figure>
                                <div class="fh5co-property-innter" style="min-height: 132px;">
                                    <h3 class="head">Name: <a href="#">dress one</a></h3>
                                    <p>Category: <a href="#"> Dress</a></p>
                                    <div class="price-status">
                                        <span class="price">$400 </span>
                                    </div>
                                    <p class="fh5co-property-specification">
                                        <span class="label label-primary"><strong>Created</strong> 28/05/2004</span>  <span class="label label-success"><strong>3</strong> Likes</span>  <span class="label label-info"><strong>3.5</strong> Comments</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                        <a href="/clothing/1">
                            <div class="fh5co-property">
                                <figure style="height:260px;">
                                    <img src="{{ asset("/storage/clothing/dress.jpg") }}" alt="clothing" class="img-responsive">
                                </figure>
                                <div class="fh5co-property-innter" style="min-height: 132px;">
                                    <h3 class="head">Name: <a href="#">dress one</a></h3>
                                    <p>Category: <a href="#"> Dress</a></p>
                                    <div class="price-status">
                                        <span class="price">$400 </span>
                                    </div>
                                    <p class="fh5co-property-specification">
                                        <span class="label label-primary"><strong>Created</strong> 28/05/2004</span>  <span class="label label-success"><strong>3</strong> Likes</span>  <span class="label label-info"><strong>3.5</strong> Comments</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                        <a href="/clothing/1">
                            <div class="fh5co-property">
                                <figure style="height:260px;">
                                    <img src="{{ asset("/storage/clothing/dress.jpg") }}" alt="clothing" class="img-responsive">
                                </figure>
                                <div class="fh5co-property-innter" style="min-height: 132px;">
                                    <h3 class="head">Name: <a href="#">dress one</a></h3>
                                    <p>Category: <a href="#"> Dress</a></p>
                                    <div class="price-status">
                                        <span class="price">$400 </span>
                                    </div>
                                    <p class="fh5co-property-specification">
                                        <span class="label label-primary"><strong>Created</strong> 28/05/2004</span>  <span class="label label-success"><strong>3</strong> Likes</span>  <span class="label label-info"><strong>3.5</strong> Comments</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

            </div>
            <!-- /.box-body -->
        </div>

    </section>

    <section class="@if(!$errors->any()) hidden @endif col-lg-6 connectedSortable new-clothing ">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Add clothing</h3>
            </div>

            <form class="" method="POST" action="{{ route('clothing.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Name</label>

                        <div class="">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                            <select class="form-control" name="category" id="category" required>
                                <option value="">--select--</option>
                                @foreach($categories as $value)
                                    <option value="{{ $value->key }}">{{ $value->name }}</option>
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
                            <input id="picture" type="file" class="form-control" name="picture" required>

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
                $("section.new-clothing").toggleClass("hidden");
                $("section.show-clothing").toggleClass("hidden");
                if($("section.show-clothing").hasClass("hidden")) $("button.new").html("<i class='fa fa-arrow-circle-right'></i> <span>Back</span>");
                if($("section.new-clothing").hasClass("hidden")) $("button.new").html("<i class='fa fa-plus'></i> <span>New</span>");
            })
        })
    </script>
@endsection