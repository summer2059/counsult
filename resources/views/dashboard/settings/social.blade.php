<div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">

                    {{-- Facebook Link --}}
                    <div class="form-group row">
                        <label for="facebook_link" class="col-sm-2 control-label">Facebook Link</label>
                        <div class="col-sm-5">
                            <input type="text" name="facebook_link" class="form-control mb-3" id="facebook_link"
                                placeholder="English" value="{{ getConfiguration('facebook_link') }}">
                            @error('facebook_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_facebook_link" class="form-control mb-3" id="jp_facebook_link"
                                placeholder="Japanese" value="{{ getConfiguration('jp_facebook_link') }}">
                            @error('jp_facebook_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="linkedin_link" class="col-sm-2 control-label">Linkedin Link</label>
                        <div class="col-sm-5">
                            <input type="text" name="linkedin_link" class="form-control mb-3" id="linkedin_link"
                                placeholder="English" value="{{ getConfiguration('linkedin_link') }}">
                            @error('linkedin_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_linkedin_link" class="form-control mb-3" id="jp_linkedin_link"
                                placeholder="Japanese" value="{{ getConfiguration('jp_linkedin_link') }}">
                            @error('jp_linkedin_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Twitter Link --}}
                    <div class="form-group row">
                        <label for="twitter_link" class="col-sm-2 control-label">Twitter Link</label>
                        <div class="col-sm-5">
                            <input type="text" name="twitter_link" class="form-control mb-3" id="twitter_link"
                                placeholder="English" value="{{ getConfiguration('twitter_link') }}">
                            @error('twitter_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_twitter_link" class="form-control mb-3" id="jp_twitter_link"
                                placeholder="Japanese" value="{{ getConfiguration('jp_twitter_link') }}">
                            @error('jp_twitter_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Instagram Link --}}
                    <div class="form-group row">
                        <label for="instagram_link" class="col-sm-2 control-label">Instagram Link</label>
                        <div class="col-sm-5">
                            <input type="text" name="instagram_link" class="form-control mb-3" id="instagram_link"
                                placeholder="English" value="{{ getConfiguration('instagram_link') }}">
                            @error('instagram_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_instagram_link" class="form-control mb-3" id="jp_instagram_link"
                                placeholder="Japanese" value="{{ getConfiguration('jp_instagram_link') }}">
                            @error('jp_instagram_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Optional: App Links (Commented Out by You) --}}
                    {{--
                    <div class="form-group row">
                        <label for="android_app_link" class="col-sm-2 control-label">Android App Link</label>
                        <div class="col-sm-5">
                            <input type="text" name="android_app_link" class="form-control mb-3" id="android_app_link"
                                value="{{ getConfiguration('android_app_link') }}">
                            @error('android_app_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_android_app_link" class="form-control mb-3" id="jp_android_app_link"
                                value="{{ getConfiguration('jp_android_app_link') }}">
                            @error('jp_android_app_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ios_app_link" class="col-sm-2 control-label">iOS App Link</label>
                        <div class="col-sm-5">
                            <input type="text" name="ios_app_link" class="form-control mb-3" id="ios_app_link"
                                value="{{ getConfiguration('ios_app_link') }}">
                            @error('ios_app_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_ios_app_link" class="form-control mb-3" id="jp_ios_app_link"
                                value="{{ getConfiguration('jp_ios_app_link') }}">
                            @error('jp_ios_app_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    --}}

                </div>
            </div>
        </div>
    </div>
</div>
