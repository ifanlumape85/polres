<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($slides as $i => $slide)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" @if($i==0) class="active" @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($slides as $i => $slide)
        <div class="carousel-item @if($i==0) active @endif">
            <img class="d-block w-100" src="{{ Storage::url($slide->image ?? null) }}" alt="{{ $slide->name ?? null }}" style="height:600px; object-fit:cover; object-position:center;">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section id="welcome">
    <div class="container">
        <div class="row">
            <div class="col">
                @if(Storage::disk('public')->exists($profile->profile_picture ?? null))
                <img src="{{ Storage::url($profile->profile_picture ?? null) }}" alt="" class="img-fluid" style="object-fit:cover; object-position:center;">
                @endif
            </div>
            <div class="col-8">
                {!! nl2br(e($profile->welcome_speech ?? null)) !!}
                <p class="mt-2 font-weight-bolder">{{ $profile->departemen_head ?? null }}</p>
            </div>
        </div>
    </div>
</section>