<div class="container message-section">
    <div class="row">

        @if($message->isNotEmpty())
        @foreach($message as $me)
            <div class="col-md-6 mb-4">
            <div class="message-box">
                <img src="{{asset('uploads/images/' . $me->image)}}" alt="CEO Image">
                <h4>{{$me->name}}</h4>
                <p><strong>{{$me->position}}</strong></p>
                <p>
                    "{!!$me->message!!}"
                </p>
            </div>
        </div>
        @endforeach
        
        @endif

    </div>
</div>
