@extends('frontend.layouts.app')

@section('content')
<section class="career py-6">
    <div class="container">
        <div class="section-header text-center col-lg-9 col-12 mx-auto" data-aos="fade-up">
            <h2 class="fs6 text-capitalize section__caption">Career</h2>
            <h3 class="section__title">We create best opportunities for your business.</h3>
        </div>
        @if ($career->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-main">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Position</th>
                        <th>Published Date</th>
                        <th>Last Submission Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($career as $job)
                    <tr>
                        <td data-label="Job Title">{{ $job->title }}</td>
                        <td data-label="Position">{{ $job->position }}</td>
                        <td data-label="Published Date">{{ $job->start_date }}</td>
                        <td data-label="Last Submission Date">{{ $job->end_date }}</td>
                        <td data-label="Action">
                            <a class="btn btn--table-outline" href="{{ route('career-detail', $job->slug) }}">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-center fs-5">No any vacancy</p>
        @endif
    </div>
</section>
@endsection
