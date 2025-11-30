@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-box me-2"></i>{{ __('messages.items_management') }}</h5>
                    <a href="{{ route('items.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i>{{ __('messages.add_new_item') }}
                    </a>
                </div>

                <div class="card-body">
                    @include('partials.alerts')

                    @if($items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">{{ __('messages.id') }}</th>
                                        <th><i class="fas fa-tag me-2"></i>{{ __('messages.name') }}</th>
                                        <th><i class="fas fa-folder me-2"></i>{{ __('messages.category') }}</th>
                                        <th><i class="fas fa-dollar-sign me-2"></i>{{ __('messages.price') }}</th>
                                        <th><i class="fas fa-cubes me-2"></i>{{ __('messages.qty') }}</th>
                                        <th class="text-center"><i class="fas fa-toggle-on me-2"></i>{{ __('messages.status') }}</th>
                                        <th class="text-center"><i class="fas fa-star me-2"></i>{{ __('messages.featured') }}</th>
                                        <th class="text-center"><i class="fas fa-cog me-2"></i>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $item->id }}</td>
                                            <td class="fw-semibold">
                                                <i class="fas fa-box text-primary me-2"></i>{{ $item->name }}
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-{{ $item->category === 'electronics' ? 'laptop' : ($item->category === 'books' ? 'book' : ($item->category === 'clothing' ? 'tshirt' : ($item->category === 'food' ? 'utensils' : 'cube'))) }} me-1"></i>
                                                    {{ ucfirst($item->category) }}
                                                </span>
                                            </td>
                                            <td class="text-success fw-bold">
                                                <i class="fas fa-dollar-sign me-1"></i>{{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($item->status === 'active')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>Active
                                                    </span>
                                                @elseif($item->status === 'inactive')
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times-circle me-1"></i>Inactive
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i>Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->is_featured)
                                                    <i class="fas fa-star text-warning fs-5"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-buttons d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('items.show', $item) }}"
                                                       class="btn btn-sm btn-outline-info"
                                                       data-bs-toggle="tooltip"
                                                       title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('items.edit', $item) }}"
                                                       class="btn btn-sm btn-outline-warning"
                                                       data-bs-toggle="tooltip"
                                                       title="Edit Item">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('items.destroy', $item) }}"
                                                          method="POST"
                                                          class="d-inline delete-form"
                                                          data-item-name="{{ $item->name }}"
                                                          data-item-type="{{ __('messages.item') }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ __('messages.delete_item') }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $items->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            No items found. <a href="{{ route('items.create') }}">Create your first item</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
