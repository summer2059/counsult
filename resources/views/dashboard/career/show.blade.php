@extends('dashboard.layouts.app')

@push('css')
<style>
    .card-label {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Career Details (ID: {{ $career->id }})</h4>
            <a href="{{ route('career.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>

        <div class="card-body">

            {{-- Status Badge --}}
            <div class="mb-3">
                <strong>Status:</strong>
                @if($career->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </div>

            {{-- Language Type --}}
            <div class="mb-3">
                <strong>Language Type:</strong>
                <span class="badge bg-info text-dark">{{ ucfirst($career->type->type ?? 'N/A') }}</span>
            </div>

            {{-- Tabs to toggle English/Japanese content --}}
            <ul class="nav nav-tabs" id="careerTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="english-tab" data-bs-toggle="tab" data-bs-target="#english" type="button" role="tab" aria-controls="english" aria-selected="true">English</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="japanese-tab" data-bs-toggle="tab" data-bs-target="#japanese" type="button" role="tab" aria-controls="japanese" aria-selected="false">Japanese</button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="careerTabContent">
                {{-- English Tab --}}
                <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">
                    <div class="mb-3">
                        <label class="card-label">Title (English)</label>
                        <p>{{ $career->title ?: '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="card-label">Description (English)</label>
                        <div>{!! $career->description ?: '<em>No description provided.</em>' !!}</div>
                    </div>

                    <div class="mb-3">
                        <label class="card-label">Position (English)</label>
                        <p>{{ $career->position ?: '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="card-label">Location (English)</label>
                        <p>{{ $career->location ?: '-' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="card-label">Start Date</label>
                            <p>{{ $career->start_date ? \Carbon\Carbon::parse($career->start_date)->format('F j, Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="card-label">End Date</label>
                            <p>{{ $career->end_date ? \Carbon\Carbon::parse($career->end_date)->format('F j, Y') : '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Japanese Tab --}}
                <div class="tab-pane fade" id="japanese" role="tabpanel" aria-labelledby="japanese-tab">
                    <div class="mb-3">
                        <label class="card-label">タイトル (Japanese Title)</label>
                        <p>{{ $career->jp_title ?: '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="card-label">説明 (Japanese Description)</label>
                        <div>{!! $career->jp_description ?: '<em>説明がありません。</em>' !!}</div>
                    </div>

                    <div class="mb-3">
                        <label class="card-label">ポジション (Position)</label>
                        <p>{{ $career->jp_position ?: '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="card-label">場所 (Location)</label>
                        <p>{{ $career->jp_location ?: '-' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="card-label">開始日 (Start Date)</label>
                            <p>{{ $career->jp_start_date ? \Carbon\Carbon::parse($career->jp_start_date)->format('F j, Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="card-label">終了日 (End Date)</label>
                            <p>{{ $career->jp_end_date ? \Carbon\Carbon::parse($career->jp_end_date)->format('F j, Y') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Optional: Edit button --}}
        <div class="card-footer text-end">
            <a href="{{ route('career.edit', $career->id) }}" class="btn btn-primary">Edit Career</a>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
