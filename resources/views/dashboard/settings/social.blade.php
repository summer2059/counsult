<div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">
                    <div class="form-group{{ $errors->has('facebook_link') ? ' has-error' : '' }}">
                        <label for="facebook_link" class="col-sm-2 control-label">Facebook Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="facebook_link" class="form-control" id="facebook_link"
                                   value="{{ getConfiguration('facebook_link') }}">
                            @if ($errors->has('facebook_link'))
                                <span class="help-block">
                                    {{ $errors->first('facebook_link') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('twitter_link') ? ' has-error' : '' }}">
                        <label for="twitter_link" class="col-sm-2 control-label">Twitter Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="twitter_link" class="form-control" id="twitter_link"
                                   value="{{ getConfiguration('twitter_link') }}">
                            @if ($errors->has('twitter_link'))
                                <span class="help-block">
                                    {{ $errors->first('twitter_link') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('instagram_link') ? ' has-error' : '' }}">
                        <label for="instagram_link" class="col-sm-2 control-label">Instagram Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="instagram_link" class="form-control" id="instagram_link"
                                   value="{{ getConfiguration('instagram_link') }}">
                            @if ($errors->has('instagram_link'))
                                <span class="help-block">
                                    {{ $errors->first('instagram_link') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('android_app_link') ? ' has-error' : '' }}">
                        <label for="android_app_link" class="col-sm-2 control-label">Android App Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="android_app_link" class="form-control" id="android_app_link"
                                   value="{{ getConfiguration('android_app_link') }}">
                            @if ($errors->has('android_app_link'))
                                <span class="help-block">
                                    {{ $errors->first('android_app_link') }}
                                </span> 
                            @endif
                        </div>
                    </div>

                    
                    <div class="form-group{{ $errors->has('ios_app_link') ? ' has-error' : '' }}">
                        <label for="ios_app_link" class="col-sm-2 control-label">Ios App Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="ios_app_link" class="form-control" id="ios_app_link"
                                   value="{{ getConfiguration('ios_app_link') }}">
                            @if ($errors->has('ios_app_link'))
                                <span class="help-block">
                                    {{ $errors->first('ios_app_link') }}
                                </span> 
                            @endif
                        </div>
                    </div>


                 

                </div>
            </div>
        </div>
    </div>
</div>
