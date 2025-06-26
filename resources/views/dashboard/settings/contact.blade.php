<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">

                    {{-- Office Number --}}
                    <div class="form-group row">
                        <label for="office_number" class="col-sm-2 control-label">Office Number</label>
                        <div class="col-sm-5">
                            <input type="text" name="office_number" class="form-control mb-3" id="office_number"
                                placeholder="English" value="{{ getConfiguration('office_number') }}">
                            @error('office_number')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_office_number" class="form-control mb-3" id="jp_office_number"
                                placeholder="Japanese" value="{{ getConfiguration('jp_office_number') }}">
                            @error('jp_office_number')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Mobile Number --}}
                    <div class="form-group row">
                        <label for="primary_phone_number" class="col-sm-2 control-label">Mobile Number</label>
                        <div class="col-sm-5">
                            <input type="text" name="primary_phone_number" class="form-control mb-3" id="primary_phone_number"
                                placeholder="English" value="{{ getConfiguration('primary_phone_number') }}">
                            @error('primary_phone_number')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_primary_phone_number" class="form-control mb-3" id="jp_primary_phone_number"
                                placeholder="Japanese" value="{{ getConfiguration('jp_primary_phone_number') }}">
                            @error('jp_primary_phone_number')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Email Address --}}
                    <div class="form-group row">
                        <label for="email_address" class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-5">
                            <input type="email" name="email_address" class="form-control mb-3" id="email_address"
                                placeholder="English" value="{{ getConfiguration('email_address') }}">
                            @error('email_address')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="email" name="jp_email_address" class="form-control mb-3" id="jp_email_address"
                                placeholder="Japanese" value="{{ getConfiguration('jp_email_address') }}">
                            @error('jp_email_address')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Working Hours --}}
                    <div class="form-group row">
                        <label for="site_detail" class="col-sm-2 control-label">Working Hours</label>
                        <div class="col-sm-5">
                            <input type="text" name="site_detail" class="form-control" id="site_detail"
                                placeholder="English" value="{{ getConfiguration('site_detail') }}">
                            <small>Open and closing day and time</small>
                            @error('site_detail')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="jp_site_detail" class="form-control mb-3" id="jp_site_detail"
                                placeholder="Japanese" value="{{ getConfiguration('jp_site_detail') }}">
                            @error('jp_site_detail')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
