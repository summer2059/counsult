<div class="container-fluid bg-secondary px-0">
        <div class="row g-0">
            <div class="col-lg-6 py-6 px-5">
            @if($eb && $eb->jp_title && $eb->jp_description)
                <h1 class="display-5 mb-4">{{$eb->jp_title}}</h1>
                <p class="mb-4">{!!$eb->jp_description!!}</p>
            @endif
                
                <form method="POST" action="{{ route('store.enquiry-message') }}">
                @csrf
                <input type="hidden" name="type_id" id="typeInput" value="2">
                <div class="row gy-3 gx-3">
                    <div class="col-md-6 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="input-name" placeholder="John Doe" name="name">
                            <label for="input-name">Full Name</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="input-email" placeholder="name@example.com" name="email">
                            <label for="input-email">Email Address</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="input-phone" placeholder="Phone Number" name="phone">
                            <label for="input-phone">Phone Number</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="input-address" placeholder="Address" name="address">
                            <label for="input-address">Address</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="service_id" aria-label="Select Service">
                                @foreach ($services as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Select A Service</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
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