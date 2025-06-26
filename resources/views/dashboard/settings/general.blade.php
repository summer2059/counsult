<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">

                    {{-- Site Title --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Site Title *</label>
                        <div class="col-sm-5">
                            <input type="text" name="site_title" class="form-control mb-3" placeholder="English" value="{{ getConfiguration('site_title') }}">
                            @error('site_title') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_site_title" class="form-control mb-3" placeholder="Japanese" value="{{ getConfiguration('jp_site_title') }}">
                            @error('jp_site_title') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Site Description --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Site Description</label>
                        <div class="col-sm-5">
                            <input type="text" name="site_description" class="form-control mb-3" placeholder="English" value="{{ getConfiguration('site_description') }}">
                            <small>In a few words, explain about your company.</small>
                            @error('site_description') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_site_description" class="form-control mb-3" placeholder="Japanese" value="{{ getConfiguration('jp_site_description') }}">
                            @error('jp_site_description') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Office Address --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Office Address *</label>
                        <div class="col-sm-5">
                            <textarea name="site_address" class="form-control mb-3" rows="4" placeholder="English">{{ getConfiguration('site_address') }}</textarea>
                            @error('site_address') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <textarea name="jp_site_address" class="form-control mb-3" rows="4" placeholder="Japanese">{{ getConfiguration('jp_site_address') }}</textarea>
                            @error('jp_site_address') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Google Map Address --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Google Map Address *</label>
                        <div class="col-sm-5">
                            <textarea name="map_link" class="form-control mb-3" rows="4" placeholder="English">{{ getConfiguration('map_link') }}</textarea>
                            @error('map_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <textarea name="jp_map_link" class="form-control mb-3" rows="4" placeholder="Japanese">{{ getConfiguration('jp_map_link') }}</textarea>
                            @error('jp_map_link') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Site Logo --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Site Logo</label>
                        <div class="col-sm-5">
                            <input type="file" name="site_logo" class="form-control mb-3">
                            <small>Preferred: <strong>150x110</strong></small>
                            @error('site_logo') <span class="help-block">{{ $message }}</span> @enderror
                            @if (getConfiguration('site_logo'))
                                <p class="mt-2">Current English Logo</p>
                                <img src="{{ asset(getConfiguration('site_logo')) }}" width="150" height="110" class="mb-3">
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <input type="file" name="jp_site_logo" class="form-control mb-3">
                            <small>Preferred: <strong>150x110</strong></small>
                            @error('jp_site_logo') <span class="help-block">{{ $message }}</span> @enderror
                            @if (getConfiguration('jp_site_logo'))
                                <p class="mt-2">Current Japanese Logo</p>
                                <img src="{{ asset(getConfiguration('jp_site_logo')) }}" width="150" height="110" class="mb-3">
                            @endif
                        </div>
                    </div>

                    {{-- Site Favicon --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Site Favicon</label>
                        <div class="col-sm-5">
                            <input type="file" name="site_favicon" class="form-control mb-3">
                            <small>Preferred: <strong>32x32</strong> or <strong>64x64</strong></small>
                            @error('site_favicon') <span class="help-block">{{ $message }}</span> @enderror
                            @if (getConfiguration('site_favicon'))
                                <p class="mt-2">Current English Favicon</p>
                                <img src="{{ asset(getConfiguration('site_favicon')) }}" width="32">
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <input type="file" name="jp_site_favicon" class="form-control mb-3">
                            <small>Preferred: <strong>32x32</strong> or <strong>64x64</strong></small>
                            @error('jp_site_favicon') <span class="help-block">{{ $message }}</span> @enderror
                            @if (getConfiguration('jp_site_favicon'))
                                <p class="mt-2">Current Japanese Favicon</p>
                                <img src="{{ asset(getConfiguration('jp_site_favicon')) }}" width="32">
                            @endif
                        </div>
                    </div>

                    {{-- Footer Logo --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Footer Logo</label>
                        <div class="col-sm-5">
                            <input type="file" name="footer_logo" class="form-control mb-3">
                            <small>Preferred: <strong>274x86</strong></small>
                            @error('footer_logo') <span class="help-block">{{ $message }}</span> @enderror
                            @if (getConfiguration('footer_logo'))
                                <p class="mt-2">Current English Footer Logo</p>
                                <img src="{{ asset(getConfiguration('footer_logo')) }}" width="150" height="110" class="mb-3">
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <input type="file" name="jp_footer_logo" class="form-control mb-3">
                            <small>Preferred: <strong>274x86</strong></small>
                            @error('jp_footer_logo') <span class="help-block">{{ $message }}</span> @enderror
                            @if (getConfiguration('jp_footer_logo'))
                                <p class="mt-2">Current Japanese Footer Logo</p>
                                <img src="{{ asset(getConfiguration('jp_footer_logo')) }}" width="150" height="110" class="mb-3">
                            @endif
                        </div>
                    </div>

                    {{-- Footer Description --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Footer Description</label>
                        <div class="col-sm-5">
                            <textarea name="footer_description" class="form-control mb-3" rows="4" placeholder="English">{{ getConfiguration('footer_description') }}</textarea>
                            @error('footer_description') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-5">
                            <textarea name="jp_footer_description" class="form-control mb-3" rows="4" placeholder="Japanese">{{ getConfiguration('jp_footer_description') }}</textarea>
                            @error('jp_footer_description') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Copyright --}}
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Copyright Notice</label>
                        <div class="col-sm-5">
                            <input type="text" name="copyright_notice" class="form-control mb-3" placeholder="English"
                                value="{{ getConfiguration('copyright_notice') }}">
                            @error('copyright_notice')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_copyright_notice" class="form-control mb-3"
                                placeholder="Japanese" value="{{ getConfiguration('jp_copyright_notice') }}">
                            @error('jp_copyright_notice')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
