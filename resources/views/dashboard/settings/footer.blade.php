<div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
    <div class="col-xl-12 mt-2">
        <div class="card height-equal">
            <div class="card-body custom-input">
                <div class="row g-3">
                    <div class="form-group{{ $errors->has('pdf') ? ' has-error' : '' }}">
                        <label for="pdf" class="col-sm-2 control-label">Upload PDF </label>
                        <div class="col-sm-10">
                            <input type="file" name="pdf" class="form-control" id="pdf" accept="application/pdf">
                            @if ($errors->has('pdf'))
                                <span class="help-block">
                                    {{ $errors->first('pdf') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    @if (!empty(getConfiguration('pdf')))
                    <div class="col-sm-10">
                        <iframe src="{{ asset(getConfiguration('pdf')) }}" width="600" height="500"></iframe>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
