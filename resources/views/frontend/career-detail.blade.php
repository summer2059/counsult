@extends('frontend.layouts.app')
@section('content')
    <section class="career-detail py-md mb-5">
        <div class="container">
            <div class="section-header text-center col-lg-9 col-12 mx-auto pb-3" data-aos="fade-up">
                <h2 class="fs6 text-capitalize section__caption">
                    Career
                </h2>
                <h3 class="section__title">
                    Career Details
                </h3>
            </div>
            <div class="row">

                <div class="col-xl-7 col-12">
                    <div class="job-card">
                        <h3 class="job-title mb-4">{{ $career->title }}</h3>
                        <p><strong>Position:</strong> {{ $career->position }}</p>

                        {{-- <h5 class="section-title mb-4 mt-5 fw-600">Job Description</h5>
                        <ul>
                            <li>Develop and implement strategies to enhance customer relationships.</li>
                            <li>Analyze customer data to identify trends and opportunities for improvement.</li>
                            <li>Collaborate with sales and marketing teams to align CRM initiatives with business
                                objectives.</li>
                            <li>Provide outstanding hospitality services to customers, ensuring their needs are met and
                                exceeded.</li>
                            <li>Handle customer inquiries and complaints in a professional and timely manner.</li>
                            <li>Generate reports and analyze data to support decision-making processes.</li>
                        </ul> --}}
                        <p>{!! $career->description !!}</p>

                        {{-- <h5 class="section-title mb-4 mt-4 fw-600">Job Specification</h5>
                        <ul>
                            <li>Proven experience in customer relationship management, hospitality, and MIS.</li>
                            <li>Excellent communication and interpersonal skills.</li>
                            <li>Ability to multitask and prioritize in a fast-paced environment.</li>
                            <li>Previous experience in the automotive industry would be advantageous.</li>
                        </ul> --}}
                        {{-- <p>{!! $career->job_secification !!}</p> --}}

                        {{-- <h5 class="section-title mb-4 mt-4 fw-600">Additional Information</h5> --}}
                        <p><strong>Job Posting Date:</strong> {{ $career->start_date }}</p>
                        <p><strong>Application End Date:</strong> {{ $career->end_date }}</p>
                        {{-- <p><strong>Minimum Age:</strong> 22</p>
                        <p><strong>Two Wheeler Required:</strong> No</p>
                        <p><strong>Four Wheeler Required:</strong> No</p> --}}
                    </div>
                </div>

                {{-- <div class="col-xl-7 col-12">
                    <div class="job-card">
                        <h3 class="job-title mb-4">CRM Officer</h3>
                        <p><strong>Vacancy ID:</strong> 12380</p>
                        <p><strong>Division:</strong> default_category</p>
                        <p><strong>Position:</strong> Officer</p>

                        <h5 class="section-title mb-4 mt-5 fw-600">Job Description</h5>
                        <ul>
                            <li>Develop and implement strategies to enhance customer relationships.</li>
                            <li>Analyze customer data to identify trends and opportunities for improvement.</li>
                            <li>Collaborate with sales and marketing teams to align CRM initiatives with business
                                objectives.</li>
                            <li>Provide outstanding hospitality services to customers, ensuring their needs are met and
                                exceeded.</li>
                            <li>Handle customer inquiries and complaints in a professional and timely manner.</li>
                            <li>Generate reports and analyze data to support decision-making processes.</li>
                        </ul>

                        <h5 class="section-title mb-4 mt-4 fw-600">Job Specification</h5>
                        <ul>
                            <li>Proven experience in customer relationship management, hospitality, and MIS.</li>
                            <li>Excellent communication and interpersonal skills.</li>
                            <li>Ability to multitask and prioritize in a fast-paced environment.</li>
                            <li>Previous experience in the automotive industry would be advantageous.</li>
                        </ul>

                        <h5 class="section-title mb-4 mt-4 fw-600">Additional Information</h5>
                        <p><strong>Job Posting Date:</strong> 2024-02-22</p>
                        <p><strong>Application End Date:</strong> 2024-02-29</p>
                        <p><strong>Minimum Age:</strong> 22</p>
                        <p><strong>Two Wheeler Required:</strong> No</p>
                        <p><strong>Four Wheeler Required:</strong> No</p>
                    </div>
                </div> --}}
                <div class="col-xl-5 col-12">
                    <div class="contact apply-job p-4 shadow-sm rounded" style="background: var(--secondary);">
                        <div class="form-wrapper">
                            <h5 class="mb-4 fw-600 text-dark">Apply For this Position</h5>
                            <form class="d-flex flex-column gap-lg-4 gap-3" method="POST" action="{{route('store.career')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="career_id" value="{{ $career->id }}">
                                <input type="hidden" name="type_id" value="1">

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="first_name" class="form-label fw-semibold text-dark">
                                            First name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="first_name" id="first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="last_name" class="form-label fw-semibold text-dark">
                                            Last name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="last_name" id="last_name"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label fw-semibold text-dark">
                                            Email address <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter your email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="phone_number" class="form-label fw-semibold text-dark">
                                            Phone number <span class="text-danger">*</span>
                                        </label>
                                        <input type="tel" name="phone_number" id="phone_number"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            placeholder="Provide Phone Number" value="{{ old('phone_number') }}" required>
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="upload-box text-center border border-2 rounded py-3"
                                            style="cursor: pointer; background: var(--light);">
                                            <label for="cvUpload"
                                                class="upload-label d-flex flex-column align-items-center justify-content-center mb-0"
                                                style="cursor: pointer;">
                                                <img src="{{ asset('frontend/svg/upload.svg') }}" alt="Upload Icon"
                                                    height="48" width="48" />
                                                <p class="fs14 upload-text mt-2 mb-0" id="fileName"
                                                    style="color: var(--dark); font-weight: 600;">Upload Your CV</p>
                                            </label>
                                            <input type="file" name="cv" id="cvUpload"
                                                class="upload-input @error('cv') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx" hidden required>
                                            @error('cv')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-lg w-100"
                                            style="background-color: var(--primary); border-color: var(--primary); font-weight: 600; transition: background-color 0.3s;">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
@endsection
@push('js')

        <script>
        console.log('Career Detail Page Loaded');
  document.getElementById('cvUpload').addEventListener('change', function() {
    const fileNameDisplay = document.getElementById('fileName');
    if (this.files && this.files.length > 0) {
      fileNameDisplay.textContent = this.files[0].name;
    } else {
      fileNameDisplay.textContent = 'Upload Your CV';
    }
  });
</script>
    @endpush
