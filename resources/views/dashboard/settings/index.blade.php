@extends('dashboard.layouts.app')

@section('content')
    <div class="col-sm-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4>Site Settings</h4>
            </div>
            <div class="card-body">
                <ul class="simple-wrapper nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active txt-primary" id="general-tab" data-bs-toggle="tab"
                            href="#general" role="tab" aria-controls="general" aria-selected="true">General</a></li>
                    <li class="nav-item"><a class="nav-link txt-primary" id="contact-tab" data-bs-toggle="tab"
                            href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a></li>
                    <li class="nav-item"><a class="nav-link txt-primary" id="social-tab" data-bs-toggle="tab"
                                href="#social" role="tab" aria-controls="social" aria-selected="false">Social Links</a></li>

                </ul>
                <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="tab-content" id="myTabContent">

                        @include('dashboard.settings.general')
                        @include('dashboard.settings.contact')
                        @include('dashboard.settings.social')
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                          <button class="btn btn-primary me-3" type="submit">Update</button>
                        </div>
                      </div>
                </form>

            </div>
        </div>
    </div>
@endsection
