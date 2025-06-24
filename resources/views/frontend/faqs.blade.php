@extends('frontend.layouts.app')
@section('content')
    <section class="banner py-5 bg-light">
        <div class="container">
            <div class="banner__inner text-center">
                <div class="section-header mb-4">
                    <h2 class="fs6 text-uppercase text-primary fw-bold section__caption mb-2">
                        Frequently Asked Questions
                    </h2>
                    <h3 class="section__title fw-bold display-6 text-dark mb-0">
                        Your Guide to Consult <br />
                        Solutions
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section class="faq py-5 bg-white">
        <div class="container">
            <div class="faq__inner d-flex flex-column w-100">
                @if ($faqs && $faqs->isNotEmpty())
                    <div class="faq-content">
                        <div class="accordion accordion-flush shadow-sm rounded" id="accordionFlush">
                            @foreach ($faqs->sortByDesc('created_at') as $faq)
                                @if ($faq->status == 1)
                                    <div class="accordion-item border-bottom mb-2">
                                        <h3 class="accordion-header" id="flush-heading{{ $faq->id }}">
                                            <button class="accordion-button collapsed bg-white text-dark fw-bold"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $faq->id }}" aria-expanded="false"
                                                aria-controls="flush-collapse{{ $faq->id }}"
                                                style="transition: background 0.3s ease;">
                                                {{ $faq->question }}
                                            </button>
                                        </h3>
                                        <div id="flush-collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading{{ $faq->id }}"
                                            data-bs-parent="#accordionFlush">
                                            <div class="accordion-body">
                                                {!! $faq->answer !!}
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        No FAQs available at the moment.
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
