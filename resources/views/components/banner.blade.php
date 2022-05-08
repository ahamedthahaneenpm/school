@if($banner->multiple)
<div class="carousel-inner">
    @foreach ($banner->items as $bannerItem)
    <div class="carousel-item @if($loop->first) active @endif">
        <div class="banner_text">
            <h1>capture your<br>valuble moments</h1>
            <a href="#"><img src="{{ asset('images/web/arrow.png')}}"> LEARN MORE ABOUT US</a>
        </div>
        <img src="{{Storage::disk('school')->url($bannerItem->file)}}" class="d-block w-100" alt="...">
    </div>
    @endforeach
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#{{$id}}" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#{{$id}}" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
@else
<div class="carousel-inner">
    <div class="carousel-item">
        <img src="{{Storage::disk('school')->url($banner->file)}}" class="d-block w-100" alt="...">
    </div>
</div>
@endif