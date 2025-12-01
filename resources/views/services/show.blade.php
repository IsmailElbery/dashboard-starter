@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-concierge-bell me-2"></i>Service Details</span>
                        <div>
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Title -->
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">{{ __('messages.title') }}</h5>
                                <h3 class="fw-bold">{{ $service->title }}</h3>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">{{ __('messages.description') }}</h5>
                                <p class="lead">{{ $service->description }}</p>
                            </div>

                            <div class="row">
                                <!-- Order -->
                                <div class="col-md-6 mb-3">
                                    <h6 class="text-muted">Order</h6>
                                    <p class="fs-5">
                                        <span class="badge bg-primary">{{ $service->order }}</span>
                                    </p>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <h6 class="text-muted">Status</h6>
                                    <p class="fs-5">
                                        @if($service->is_active)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Timestamps -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>Created: {{ $service->created_at->format('M d, Y h:i A') }}
                                    </small>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>Updated: {{ $service->updated_at->format('M d, Y h:i A') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Photo -->
                            @if($service->photo)
                                <div class="mb-3">
                                    <h6 class="text-muted mb-2">Photo</h6>
                                    <img src="{{ asset('storage/' . $service->photo) }}"
                                         alt="{{ $service->title }}"
                                         class="img-fluid rounded shadow-sm"
                                         style="width: 100%; max-height: 400px; object-fit: cover;">
                                </div>
                            @else
                                <div class="text-center p-5 border rounded bg-light">
                                    <i class="fas fa-image text-muted" style="font-size: 4rem;"></i>
                                    <p class="text-muted mt-3">No photo uploaded</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex gap-2">
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit Service
                            </a>
                            <form action="{{ route('services.destroy', $service) }}"
                                  method="POST"
                                  class="d-inline delete-form"
                                  data-item-name="{{ $service->title }}"
                                  data-item-type="{{ __('messages.service') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt me-1"></i>{{ __('messages.delete_service') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
