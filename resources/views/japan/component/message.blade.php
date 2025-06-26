<div class="container message-section">
    <div class="row">

        @if($message->isNotEmpty())
        @foreach($message as $me)
            <div class="col-md-6 mb-4">
            <div class="message-box">
                <img src="{{asset('uploads/images2/' . $me->image2)}}" alt="CEO Image">
                <h4>{{$me->jp_name}}</h4>
                <p><strong>{{$me->jp_position}}</strong></p>
                <p>
                    "{!!$me->jp_message!!}"
                </p>
            </div>
        </div>
        @endforeach
        
        @endif

    </div>
</div>
