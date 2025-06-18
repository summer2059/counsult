<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">

                    <div class="form-group{{ $errors->has('office_number') ? ' has-error' : '' }}">
                        <label for="office_number" class="col-sm-2 control-label">Office Number </label>
                        <div class="col-sm-10">
                            <input type="text" name="office_number" class="form-control" id="office_number"
                                value="{{ getConfiguration('office_number') }}">
                            @if ($errors->has('office_number'))
                                <span class="help-block">
                                    {{ $errors->first('office_number') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('primary_phone_number') ? ' has-error' : '' }}">
                        <label for="primary_phone_number" class="col-sm-2 control-label">Mobile Number</label>
                        <div class="col-sm-10">
                            <input type="text" name="primary_phone_number" class="form-control"
                                id="primary_phone_number" value="{{ getConfiguration('primary_phone_number') }}">
                            @if ($errors->has('primary_phone_number'))
                                <span class="help-block">
                                    {{ $errors->first('primary_phone_number') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email_address') ? ' has-error' : '' }}">
                        <label for="email_address" class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-10">
                            <input type="email" name="email_address" class="form-control" id="email_address"
                                value="{{ getConfiguration('email_address') }}">
                            @if ($errors->has('email_address'))
                                <span class="help-block">
                                    {{ $errors->first('email_address') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('site_detail') ? ' has-error' : '' }}">
                        <label for="site_detail" class="col-sm-2 control-label">Working Hours</label>
                        <div class="col-sm-10">
                            <input type="text" name="site_detail" class="form-control" id="site_detail"
                                value="{{ getConfiguration('site_detail') }}">
                            <small>Open and closing day and time</small>
                            @if ($errors->has('site_detail'))
                                <span class="help-block">
                                    {{ $errors->first('site_detail') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
