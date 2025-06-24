<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">
                    <div class="form-group{{ $errors->has('site_title') ? ' has-error' : '' }}">
                        <label for="site_title" class="col-sm-2 control-label">Site Title *</label>
                        <div class="col-sm-10">
                            <input type="text" name="site_title" class="form-control" id="site_title"
                                value="{{ getConfiguration('site_title') }}">
                            @if ($errors->has('site_title'))
                                <span class="help-block">
                                    {{ $errors->first('site_title') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('site_description') ? ' has-error' : '' }}">
                        <label for="site_description" class="col-sm-2 control-label">Site Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="site_description" class="form-control" id="site_description"
                                value="{{ getConfiguration('site_description') }}">
                            <small>In a few words, explain about your company.</small>
                            @if ($errors->has('site_description'))
                                <span class="help-block">
                                    {{ $errors->first('site_description') }}
                                </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('site_address') ? ' has-error' : '' }}">
                        <label for="site_address" class="col-sm-2 control-label">Office Address *</label>
                        <div class="col-sm-10">
                            <textarea name="site_address" id="site_address" class="form-control" rows="4">{{ getConfiguration('site_address') }}</textarea>
                            @if ($errors->has('site_address'))
                                <span class="help-block">
                                    {{ $errors->first('site_address') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('map_link') ? ' has-error' : '' }}">
                        <label for="map_link" class="col-sm-2 control-label">Google Map Address *</label>
                        <div class="col-sm-10">
                            <textarea name="map_link" id="map_link" class="form-control" rows="6">{{ getConfiguration('map_link') }}</textarea>
                            @if ($errors->has('map_link'))
                                <span class="help-block">
                                    {{ $errors->first('map_link') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('site_logo') ? ' has-error' : '' }}">
                        <label for="site_logo" class="col-sm-2 control-label">Site Logo</label>
                        <div class="col-sm-10">
                            <input type="file" name="site_logo" id="site_logo" class="form-control">
                            <small>Preferred dimensions: <strong>150x110</strong></small>
                            @if ($errors->has('site_logo'))
                                <span class="help-block">
                                    {{ $errors->first('site_logo') }}
                                </span>
                            @endif

                            @if (getConfiguration('site_logo'))
                                <div class="half-width" style="margin: 10px 0px;">
                                    <p>Current logo</p>
                                    <img src="{{ asset(getConfiguration('site_logo')) }}"
                                        class="thumbnail img-responsive" width="150px" height="110px">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('site_favicon') ? ' has-error' : '' }}">
                        <label for="site_favicon" class="col-sm-2 control-label">Site Favicon</label>
                        <div class="col-sm-10">
                            <input type="file" name="site_favicon" id="site_favicon" class="form-control">
                            <small>Preferred dimensions: <strong>32x32</strong> or <strong>64x64</strong></small>
                            @if ($errors->has('site_favicon'))
                                <span class="help-block">
                                    {{ $errors->first('site_favicon') }}
                                </span>
                            @endif

                            @if (getConfiguration('site_favicon'))
                                <div class="mt-15 half-width">
                                    <p>Current favicon</p>
                                    <img src="{{ asset(getConfiguration('site_favicon')) }}"
                                        class="thumbnail img-responsive">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('footer_logo') ? ' has-error' : '' }}">
                        <label for="footer_logo" class="col-sm-2 control-label">Footer Logo</label>
                        <div class="col-sm-10">
                            <input type="file" name="footer_logo" id="footer_logo" class="form-control">
                            <small>Preferred dimensions: <strong>274x86</strong></small>
                            @if ($errors->has('footer_logo'))
                                <span class="help-block">
                                    {{ $errors->first('footer_logo') }}
                                </span>
                            @endif

                            @if (getConfiguration('footer_logo'))
                                <div class="half-width" style="margin: 10px 0px;">
                                    <p>Current logo</p>
                                    <img src="{{ asset(getConfiguration('footer_logo')) }}"
                                        class="thumbnail img-responsive" width="150px" height="110px">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('footer_description') ? ' has-error' : '' }}">
                        <label for="footer_description" class="col-sm-2 control-label">Footer Description</label>
                        <div class="col-sm-10">
                            <textarea name="footer_description" id="footer_description" class="form-control" rows="4">{{ getConfiguration('footer_description') }}</textarea>
                            @if ($errors->has('footer_description'))
                                <span class="help-block">
                                    {{ $errors->first('footer_description') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('copyright_notice') ? ' has-error' : '' }}">
                        <label for="copyright_notice" class="col-sm-2 control-label">Copyright Notice</label>
                        <div class="col-sm-10">
                            <input type="text" name="copyright_notice" class="form-control" id="copyright_notice"
                                value="{{ getConfiguration('copyright_notice') }}">
                            @if ($errors->has('copyright_notice'))
                                <span class="help-block">
                                    {{ $errors->first('copyright_notice') }} 
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
