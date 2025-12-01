@extends('layouts.app')

@section('content')
<style>
/* Custom Pagination Styling */
.pagination {
    margin: 0;
    gap: 0.5rem;
}

.pagination .page-item {
    margin: 0 2px;
}

.pagination .page-link {
    color: #006C35;
    border: 2px solid #D4D4D4;
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    min-width: 40px;
    text-align: center;
}

.pagination .page-link:hover {
    background-color: #006C35;
    color: white;
    border-color: #006C35;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 108, 53, 0.2);
}

.pagination .page-item.active .page-link {
    background-color: #006C35;
    border-color: #006C35;
    color: white;
    box-shadow: 0 4px 8px rgba(0, 108, 53, 0.3);
}

.pagination .page-item.disabled .page-link {
    background-color: #F5F5F5;
    border-color: #D4D4D4;
    color: #737373;
    cursor: not-allowed;
}

.pagination .page-link:focus {
    box-shadow: 0 0 0 0.25rem rgba(0, 108, 53, 0.25);
}
</style>

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
                                                <span class="badge status-badge {{ $service->is_active ? 'bg-success' : 'bg-danger' }}"
                                                      style="cursor: pointer;"
                                                      onclick="toggleStatus({{ $service->id }}, this)"
                                                      data-service-id="{{ $service->id }}"
                                                      data-is-active="{{ $service->is_active ? '1' : '0' }}">
                                                    <i class="fas {{ $service->is_active ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                                    <span class="status-text">{{ $service->is_active ? 'Active' : 'Inactive' }}</span>
                                                </span>
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

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $services->links('pagination::bootstrap-5') }}
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

@push('scripts')
<script>
function toggleStatus(serviceId, element) {
    const badge = element;
    const icon = badge.querySelector('i');
    const statusText = badge.querySelector('.status-text');
    const currentStatus = badge.dataset.isActive === '1';

    // Disable clicking temporarily
    badge.style.pointerEvents = 'none';
    badge.style.opacity = '0.6';

    // Make AJAX request
    fetch(`/admin/services/${serviceId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update badge appearance
            badge.dataset.isActive = data.is_active ? '1' : '0';

            if (data.is_active) {
                badge.classList.remove('bg-danger');
                badge.classList.add('bg-success');
                icon.classList.remove('fa-times-circle');
                icon.classList.add('fa-check-circle');
                statusText.textContent = 'Active';
            } else {
                badge.classList.remove('bg-success');
                badge.classList.add('bg-danger');
                icon.classList.remove('fa-check-circle');
                icon.classList.add('fa-times-circle');
                statusText.textContent = 'Inactive';
            }

            // Show success message
            if (typeof showSuccessAlert === 'function') {
                showSuccessAlert(data.message);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (typeof showErrorAlert === 'function') {
            showErrorAlert('{{ __("messages.error") }}');
        }
    })
    .finally(() => {
        // Re-enable clicking
        badge.style.pointerEvents = 'auto';
        badge.style.opacity = '1';
    });
}
</script>
@endpush
@endsection
