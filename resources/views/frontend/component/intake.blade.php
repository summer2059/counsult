<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- Banner Section -->
@if (!$intakebanner->isEmpty())
  <div class="position-relative overflow-hidden >
    <div class="swiper">
      <div class="swiper-wrapper">
        @foreach ($intakebanner as $ib)
          <div class="swiper-slide">
            <img src="{{asset('uploads/images/' . $ib->image)}}"
                alt="Image"
                style="width: 100%; height: 100%; object-fit: cover;" />
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
<!-- Intakes Section -->
@if (!$intakes->isEmpty())
<section class="py-5 text-center">
  <div class="container">
    <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">

      <!-- Intakes Label -->
      <div class="intake-btn intake-title">
        Intakes
      </div>

      <!-- Month Buttons -->
      
        @foreach ($intakes as $intake)
          <div class="intake-btn intake-month bg-red text-white">{{$intake->name}}</div>
        @endforeach

      <!-- Apply Button -->
      <a href="{{ route('contact') }}" class="intake-btn intake-apply">Apply<br>Now</a>

    </div>
  </div>
</section>
@endif
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    speed: 1000,
  });
</script>

<!-- Custom Styling -->
<style>
  .intake-btn {
    padding: 14px 28px;
    font-weight: bold;
    font-size: 1.1rem;
    border-radius: 8px;
    text-align: center;
    min-width: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .intake-title {
    background-color: #0d6efd;
    color: #ffc107;
    border-radius: 12px;
  }

  .bg-red {
    background-color: #d71920;
  }

  .intake-month {
    color: white;
    background-color: #d71920;
  }

  .intake-apply {
    background-color: #0d6efd;
    color: #ffc107;
    text-decoration: none;
    border-radius: 0 20px 20px 0;
    line-height: 1.2;
  }

  .gap-3 {
    gap: 1rem;
  }

  @media (max-width: 768px) {
    .intake-btn {
      width: 100%;
      min-width: auto;
      margin-bottom: 10px;
    }

    .d-flex.flex-wrap {
      flex-direction: column;
      align-items: stretch;
    }
  }
</style>
