<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gallery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <!-- GLightbox CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
  <style>
    .gallery-image {
      overflow: hidden;
      border-radius: 12px;
      position: relative;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .gallery-image img {
      width: 100%;
      height: auto;
      transition: transform 0.5s ease;
      display: block;
    }

    .gallery-image:hover img {
      transform: scale(1.1);
    }
  </style>
</head>
<body>

  <div class="container py-6">
    <h2 class="text-center font-weight-bold mb-5">Our Gallery</h2>
    <div class="row g-4">

      <!-- Gallery Item -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="{{ asset('frontend/img/feature.jpg')}}" class="glightbox gallery-image" data-gallery="gallery1">
          <img src="{{ asset('frontend/img/feature.jpg')}}" alt="Gallery Image" class="img-fluid rounded">
        </a>
      </div>

      <!-- Repeat -->
      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="{{ asset('frontend/img/quote.jpg')}}" class="glightbox gallery-image" data-gallery="gallery1">
          <img src="{{ asset('frontend/img/quote.jpg')}}" alt="Gallery Image" class="img-fluid rounded">
        </a>
      </div>

      <!-- Add more images similarly -->
    </div>
  </div>

  <!-- Bootstrap & GLightbox JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
  <script>
    const lightbox = GLightbox({ selector: '.glightbox' });
  </script>
</body>
</html>
