 @extends('japan.layouts.app')
@section('content')
<!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Blog Detail</h1>
                <a href="">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Blog Detail</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid w-100 mb-5" src="img/blog-1.jpg" alt="">
                    <h1 class="mb-4">Diam dolor est labore duo ipsum clita sed et lorem tempor duo</h1>
                    <p>Sadipscing labore amet rebum est et justo gubergren. Et eirmod ipsum sit diam ut
                        magna lorem. Nonumy vero labore lorem sanctus rebum et lorem magna kasd, stet
                        amet magna accusam consetetur eirmod. Kasd accusam sit ipsum sadipscing et at at
                        sanctus et. Ipsum sit gubergren dolores et, consetetur justo invidunt at et
                        aliquyam ut et vero clita. Diam sea sea no sed dolores diam nonumy, gubergren
                        sit stet no diam kasd vero.</p>
                    <p>Voluptua est takimata stet invidunt sed rebum nonumy stet, clita aliquyam dolores
                        vero stet consetetur elitr takimata rebum sanctus. Sit sed accusam stet sit
                        nonumy kasd diam dolores, sanctus lorem kasd duo dolor dolor vero sit et. Labore
                        ipsum duo sanctus amet eos et. Consetetur no sed et aliquyam ipsum justo et,
                        clita lorem sit vero amet amet est dolor elitr, stet et no diam sit. Dolor erat
                        justo dolore sit invidunt.</p>
                    <p>Diam dolor est labore duo invidunt ipsum clita et, sed et lorem voluptua tempor
                        invidunt at est sanctus sanctus. Clita dolores sit kasd diam takimata justo diam
                        lorem sed. Magna amet sed rebum eos. Clita no magna no dolor erat diam tempor
                        rebum consetetur, sanctus labore sed nonumy diam lorem amet eirmod. No at tempor
                        sea diam kasd, takimata ea nonumy elitr sadipscing gubergren erat. Gubergren at
                        lorem invidunt sadipscing rebum sit amet ut ut, voluptua diam dolores at
                        sadipscing stet. Clita dolor amet dolor ipsum vero ea ea eos.</p>
                </div>
                <!-- Blog Detail End -->

                <!-- Comment List Start -->
                <div class="mb-5">
                    <h2 class="mb-4">3 Comments</h2>
                    <div class="d-flex mb-4">
                        <img src="img/user.jpg" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                            <button class="btn btn-sm btn-light">Reply</button>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <img src="img/user.jpg" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                            <button class="btn btn-sm btn-light">Reply</button>
                        </div>
                    </div>
                    <div class="d-flex ms-5 mb-4">
                        <img src="img/user.jpg" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                            <button class="btn btn-sm btn-light">Reply</button>
                        </div>
                    </div>
                </div>
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="bg-secondary p-5">
                    <h2 class="mb-4">Leave a comment</h2>
                    <form>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control bg-white border-0" placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control bg-white border-0" placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-white border-0" placeholder="Website" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0" rows="5" placeholder="Comment"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Leave Your Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Comment Form End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-secondary p-4">
                        <a class="h5 mb-3" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Web Design</a>
                        <a class="h5 mb-3" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Web Development</a>
                        <a class="h5 mb-3" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Web Development</a>
                        <a class="h5 mb-3" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Keyword Research</a>
                        <a class="h5" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Email Marketing</a>
                    </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex">
                        <img class="img-fluid" src="img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                </div>
                <!-- Recent Post End -->

                <!-- Image Start -->
                <div class="mb-5">
                    <img src="img/blog-1.jpg" alt="" class="img-fluid">
                </div>
                <!-- Image End -->

                <!-- Tags Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Tag Cloud</h2>
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-secondary m-1">Design</a>
                        <a href="" class="btn btn-secondary m-1">Development</a>
                        <a href="" class="btn btn-secondary m-1">Marketing</a>
                        <a href="" class="btn btn-secondary m-1">SEO</a>
                        <a href="" class="btn btn-secondary m-1">Writing</a>
                        <a href="" class="btn btn-secondary m-1">Consulting</a>
                        <a href="" class="btn btn-secondary m-1">Design</a>
                        <a href="" class="btn btn-secondary m-1">Development</a>
                        <a href="" class="btn btn-secondary m-1">Marketing</a>
                        <a href="" class="btn btn-secondary m-1">SEO</a>
                        <a href="" class="btn btn-secondary m-1">Writing</a>
                        <a href="" class="btn btn-secondary m-1">Consulting</a>
                    </div>
                </div>
                <!-- Tags End -->

                <!-- Plain Text Start -->
                <div>
                    <h2 class="mb-4">Plain Text</h2>
                    <div class="bg-secondary text-center" style="padding: 30px;">
                        <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                        <a href="" class="btn btn-primary rounded-pill py-2 px-4">Read More</a>
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
@endsection