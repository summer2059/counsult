<section class="py-6 text-center">
  <div class="container-fluid py-6 px-5">
    @if ($cd && $cd->title && $cd->description)
      <h2 class="text-uppercase font-weight-bold mb-4" style="color: var(--primary);">{{$cd->title}}</h2>
      <p class="mb-5" style="color: var(--dark); font-size: 1.1rem;">
        {!!$cd->description!!}
      </p>
    @endif
    
    @if ($city->isNotEmpty())
      <div class="row g-4">
        @foreach ($city as $sit)
          <div class="col-md-4 col-sm-6">
            <div class="menu-card">
              <img src="{{asset('uploads/images/' . $sit->image)}}" alt="{{$sit->title}}">
              <div class="py-3" style="background-color: var(--secondary);">
                <h5 class="font-weight-bold mb-0">{{$sit->title}}</h5>
              </div>
            </div>
        </div>
       @endforeach
    </div>
    @endif
    
  </div>
</section>
