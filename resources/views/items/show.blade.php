@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Item Details: {{ $item->name }}</span>
                        <div>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('items.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6 mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Basic Information</h5>

                            <div class="mb-3">
                                <strong>ID:</strong>
                                <p class="mb-0">{{ $item->id }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Name:</strong>
                                <p class="mb-0">{{ $item->name }}</p>
                            </div>

                            @if($item->email)
                                <div class="mb-3">
                                    <strong>Email:</strong>
                                    <p class="mb-0"><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></p>
                                </div>
                            @endif

                            @if($item->description)
                                <div class="mb-3">
                                    <strong>Description:</strong>
                                    <p class="mb-0">{{ $item->description }}</p>
                                </div>
                            @endif

                            @if($item->url)
                                <div class="mb-3">
                                    <strong>URL:</strong>
                                    <p class="mb-0"><a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></p>
                                </div>
                            @endif
                        </div>

                        <!-- Pricing & Inventory -->
                        <div class="col-md-6 mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Pricing & Inventory</h5>

                            <div class="mb-3">
                                <strong>Price:</strong>
                                <p class="mb-0 text-success fs-4">${{ number_format($item->price, 2) }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Quantity:</strong>
                                <p class="mb-0">{{ $item->quantity }} units</p>
                            </div>

                            <div class="mb-3">
                                <strong>Status:</strong>
                                <p class="mb-0">
                                    @if($item->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($item->status === 'inactive')
                                        <span class="badge bg-danger">Inactive</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mb-3">
                                <strong>Category:</strong>
                                <p class="mb-0"><span class="badge bg-secondary">{{ ucfirst($item->category) }}</span></p>
                            </div>

                            <div class="mb-3">
                                <strong>Type:</strong>
                                <p class="mb-0"><span class="badge bg-info">{{ strtoupper(str_replace('_', ' ', $item->type)) }}</span></p>
                            </div>

                            @if($item->color)
                                <div class="mb-3">
                                    <strong>Color:</strong>
                                    <p class="mb-0">
                                        <span class="d-inline-block" style="width: 30px; height: 30px; background-color: {{ $item->color }}; border: 1px solid #ddd; border-radius: 4px;"></span>
                                        <span class="ms-2">{{ $item->color }}</span>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Dates -->
                        <div class="col-md-6 mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Dates</h5>

                            @if($item->manufacturing_date)
                                <div class="mb-3">
                                    <strong>Manufacturing Date:</strong>
                                    <p class="mb-0">{{ $item->manufacturing_date->format('F d, Y') }}</p>
                                </div>
                            @endif

                            @if($item->expiry_date)
                                <div class="mb-3">
                                    <strong>Expiry Date:</strong>
                                    <p class="mb-0">{{ $item->expiry_date->format('F d, Y h:i A') }}</p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <strong>Created At:</strong>
                                <p class="mb-0">{{ $item->created_at->format('F d, Y h:i A') }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Last Updated:</strong>
                                <p class="mb-0">{{ $item->updated_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Flags & Features -->
                        <div class="col-md-6 mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Flags & Features</h5>

                            <div class="mb-3">
                                <strong>Featured:</strong>
                                <p class="mb-0">
                                    @if($item->is_featured)
                                        <span class="badge bg-info">Yes</span>
                                    @else
                                        <span class="badge bg-light text-dark">No</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mb-3">
                                <strong>Available:</strong>
                                <p class="mb-0">
                                    @if($item->is_available)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </p>
                            </div>

                            @if($item->features && count($item->features) > 0)
                                <div class="mb-3">
                                    <strong>Features:</strong>
                                    <div class="mt-2">
                                        @foreach($item->features as $feature)
                                            <span class="badge bg-primary me-1 mb-1">{{ ucfirst($feature) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Files -->
                        @if($item->image || $item->document)
                            <div class="col-md-12 mb-4">
                                <h5 class="border-bottom pb-2 mb-3">Files</h5>

                                <div class="row">
                                    @if($item->image)
                                        <div class="col-md-6 mb-3">
                                            <strong>Image:</strong>
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                                     class="img-fluid img-thumbnail" style="max-height: 300px;">
                                            </div>
                                        </div>
                                    @endif

                                    @if($item->document)
                                        <div class="col-md-6 mb-3">
                                            <strong>Document:</strong>
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $item->document) }}" target="_blank" class="btn btn-outline-primary">
                                                    <i class="bi bi-file-earmark-pdf"></i> View Document
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Notes -->
                        @if($item->notes)
                            <div class="col-md-12 mb-4">
                                <h5 class="border-bottom pb-2 mb-3">Notes</h5>
                                <p>{{ $item->notes }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <form action="{{ route('items.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Item</button>
                        </form>
                        <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">Edit Item</a>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
