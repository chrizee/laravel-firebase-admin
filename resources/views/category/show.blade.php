@extends("layouts.app2")

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="{{ route("clothing.index") }}"><button class="btn btn-sm btn-default new"><i class="fa fa-plus"></i> New</button></a>
    </div>
<section class="col-lg-12 show-clothing connectedSortable">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Clothing in {{ $category_name }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            @if(count($clothings) > 0)
                @foreach($clothings as $key => $clothing)
                    @include("clothing.template")
                @endforeach
            @else
                <p class="text text-center text-info">No clothing.</p>
            @endif

        </div>
        <!-- /.box-body -->
    </div>

</section>
@endsection