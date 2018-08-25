<div class="@isset($link) col-md-4 @endisset item-block animate-box" data-animate-effect="fadeIn">
    @isset($link)
        <a href="{{ route("clothing.show", $clothing->key) }}">
            @endisset
            <div class="fh5co-property">
                <figure style="height:260px;">
                    <img src="{{ asset("/storage/clothing/".$clothing->picture) }}" alt="clothing" class="center-block img-responsive">
                </figure>
                <div class="fh5co-property-innter" style="min-height: 132px;">
                    <h3 class="head">Name: {{ $clothing->name }}</h3>
            @isset($link)
        </a>
    @endisset
    <p>Category: <a href="{{ route("categories.show", $clothing->category_key) }}"> {{ $clothing->category_name }}</a></p>

    <p class="fh5co-property-specification">
        <span class="label label-warning"><strong>Created: </strong> {{ $clothing->created_at->toFormattedDateString() }}</span>
        <span class="label label-success"><strong>{{ $clothing->likes }}</strong> Likes</span>
        <span class="label label-info"><strong>{{ $clothing->comments }}</strong> Comments</span>
    </p>
</div>
</div>
</div>