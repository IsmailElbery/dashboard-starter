@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-concierge-bell me-2"></i>{{ __('messages.services_management') }}</h5>
                    <a href="{{ route('services.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i>{{ __('messages.add_new_service') }}
                    </a>
                </div>

                <div class="card-body">
                    @include('partials.alerts')

                    @if($services->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">{{ __('messages.id') }}</th>
                                        <th><i class="fas fa-heading me-2"></i>{{ __('messages.title') }}</th>
                                        <th><i class="fas fa-align-left me-2"></i>{{ __('messages.description') }}</th>
                                        <th class="text-center"><i class="fas fa-sort-numeric-up me-2"></i>{{ __('messages.order') }}</th>
                                        <th class="text-center"><i class="fas fa-toggle-on me-2"></i>{{ __('messages.status') }}</th>
                                        <th class="text-center"><i class="fas fa-image me-2"></i>{{ __('messages.photo') }}</th>
                                        <th class="text-center"><i class="fas fa-cog me-2"></i>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $service->id }}</td>
                                            <td class="fw-semibold">
                                                <i class="fas fa-concierge-bell text-primary me-2"></i>{{ $service->title }}
                                                @if($service->title_ar)
                                                    <br>
                                                    <small class="text-muted">{{ $service->title_ar }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <div style="max-width: 300px;">
                                                    {{ Str::limit($service->description, 100) }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border">{{ $service->order }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($service->is_active)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times-circle me-1"></i>Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($service->photo)
                                                    <img src="{{ asset('storage/' . $service->photo) }}"
                                                         alt="{{ $service->title }}"
                                                         style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;"
                                                         class="rounded"
                                                         data-bs-toggle="modal"
                                                         data-bs-target="#imageModal{{ $service->id }}">
                                                @else
                                                    <i class="fas fa-image text-muted"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-buttons d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('services.show', $service) }}"
                                                       class="btn btn-sm btn-outline-info"
                                                       data-bs-toggle="tooltip"
                                                       title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('services.edit', $service) }}"
                                                       class="btn btn-sm btn-outline-warning"
                                                       data-bs-toggle="tooltip"
                                                       title="Edit Service">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('services.destroy', $service) }}"
                                                          method="POST"
                                                          class="d-inline delete-form"
                                                          data-item-name="{{ $service->title }}"
                                                          data-item-type="{{ __('messages.service') }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ __('messages.delete_service') }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Image Modal -->
                                        @if($service->photo)
                                            <div class="modal fade" id="imageModal{{ $service->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $service->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <h5 class="modal-title" id="imageModalLabel{{ $service->id }}">{{ $service->title }}</h5>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/' . $service->photo) }}"
                                                                 alt="{{ $service->title }}"
                                                                 class="img-fluid rounded"
                                                                 style="max-height: 70vh;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $services->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            No services found. <a href="{{ route('services.create') }}">Create your first service</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
