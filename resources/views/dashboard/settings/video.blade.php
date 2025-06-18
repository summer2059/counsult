<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">
                    <div class="form-group{{ $errors->has('video_title') ? ' has-error' : '' }}">
                        <label for="video_title" class="col-sm-2 control-label">Title *</label>
                        <div class="col-sm-10">
                            <input type="text" name="video_title" class="form-control" id="video_title"
                                value="{{ getConfiguration('video_title') }}">
                            @if ($errors->has('video_title'))
                                <span class="help-block">
                                    {{ $errors->first('video_title') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('video_description') ? ' has-error' : '' }}">
                        <label for="video_description" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="video_description" class="form-control" id="video_description"
                                value="{{ getConfiguration('video_description') }}">
                            <small>In a few words, explain about this section.</small>
                            @if ($errors->has('video_description'))
                                <span class="help-block">
                                    {{ $errors->first('video_description') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('site_video') ? ' has-error' : '' }}">
                        <label for="site_video" class="col-sm-2 control-label">Video</label>
                        <div class="col-sm-10">
                            <input type="file" name="site_video" id="site_video" class="form-control">
                            {{-- <small>Preferred dimensions: <strong>150x110</strong></small> --}}
                            @if ($errors->has('site_video'))
                                <span class="help-block">
                                    {{ $errors->first('site_video') }}
                                </span>
                            @endif

                            @if (getConfiguration('site_video'))
                                <div class="half-width" style="margin: 10px 0px;">
                                    <p>Current video</p>
                                    <video width="150" height="110" controls>
                                        <source src="{{ asset(getConfiguration('site_video')) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
