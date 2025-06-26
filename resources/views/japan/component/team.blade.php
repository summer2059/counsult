@if($team->isNotEmpty())
<div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Our Team Members</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
        
            @foreach($team as $tea)
                <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{asset('uploads/images/'. $tea->image)}}" alt="">
                    <div class="team-text w-100 position-absolute top-50 text-center bg-primary p-4">
                        <h3 class="text-white">{{$tea->jp_name}}</h3>
                        <p class="text-white text-uppercase mb-0">{{$tea->jp_position}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif