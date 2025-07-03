<div class="container-fluid bg-secondary px-0">
        <div class="row g-0">
            <div class="col-lg-6 py-6 px-5">
            @if($eb && $eb->jp_title && $eb->jp_description)
                
            @endif
                <h1 class="display-5 mb-4">{{$eb->jp_title}}</h1>
                <p class="mb-4">{!!$eb->jp_description!!}</p>
                <form method="post" action="{{ route('store.enquiry-message')}}">
                    @csrf
                    <div class="row gx-3">
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="form-floating-1" placeholder="John Doe" name="name">
                                <label for="form-floating-1">Full Name</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="form-floating-2" placeholder="name@example.com" name="email">
                                <label for="form-floating-2">Email address</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Financial Consultancy" name="service_id">
                                @foreach ($services as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                                @endforeach
                                </select>
                                <label for="floatingSelect">Select A Service</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary w-100 h-100" type="submit">Request A Quote</button>
                        </div>
                    </div>
                </form>
            </div>
            @if($eb && $eb->image2)
                <div class="col-lg-6" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="{{asset('uploads/images2/' .$eb->image2)}}" style="object-fit: cover;">
                </div>
            </div>
            @endif
            
        </div>
    </div>