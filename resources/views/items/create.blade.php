@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Create New Item</span>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('partials.alerts')

                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Price -->
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                       id="price" name="price" value="{{ old('price', 0) }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-4 mb-3">
                                <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                       id="quantity" name="quantity" value="{{ old('quantity', 0) }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Color -->
                            <div class="col-md-4 mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                       id="color" name="color" value="{{ old('color', '#563d7c') }}">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Manufacturing Date -->
                            <div class="col-md-6 mb-3">
                                <label for="manufacturing_date" class="form-label">Manufacturing Date</label>
                                <input type="date" class="form-control @error('manufacturing_date') is-invalid @enderror"
                                       id="manufacturing_date" name="manufacturing_date" value="{{ old('manufacturing_date') }}">
                                @error('manufacturing_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Expiry Date -->
                            <div class="col-md-6 mb-3">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="datetime-local" class="form-control @error('expiry_date') is-invalid @enderror"
                                       id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                                @error('expiry_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror"
                                        id="status" name="status" required>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-md-4 mb-3">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror"
                                        id="category" name="category" required>
                                    <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                                    <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="clothing" {{ old('category') == 'clothing' ? 'selected' : '' }}>Clothing</option>
                                    <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food</option>
                                    <option value="books" {{ old('category') == 'books' ? 'selected' : '' }}>Books</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- URL -->
                            <div class="col-md-4 mb-3">
                                <label for="url" class="form-label">URL</label>
                                <input type="url" class="form-control @error('url') is-invalid @enderror"
                                       id="url" name="url" value="{{ old('url') }}" placeholder="https://example.com">
                                @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Type (Radio Buttons) -->
                        <div class="mb-3">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="type_a"
                                           value="type_a" {{ old('type', 'type_a') == 'type_a' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="type_a">Type A</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="type_b"
                                           value="type_b" {{ old('type') == 'type_b' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type_b">Type B</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="type_c"
                                           value="type_c" {{ old('type') == 'type_c' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type_c">Type C</label>
                                </div>
                            </div>
                            @error('type')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Checkboxes -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_featured"
                                       name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured Item
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_available"
                                       name="is_available" {{ old('is_available', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">
                                    Available for Purchase
                                </label>
                            </div>
                        </div>

                        <!-- Features (Multiple Checkboxes) -->
                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="features[]"
                                           value="warranty" id="feature_warranty"
                                           {{ in_array('warranty', old('features', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="feature_warranty">Warranty</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="features[]"
                                           value="shipping" id="feature_shipping"
                                           {{ in_array('shipping', old('features', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="feature_shipping">Free Shipping</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="features[]"
                                           value="returns" id="feature_returns"
                                           {{ in_array('returns', old('features', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="feature_returns">Easy Returns</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="features[]"
                                           value="gift_wrap" id="feature_gift_wrap"
                                           {{ in_array('gift_wrap', old('features', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="feature_gift_wrap">Gift Wrap Available</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                <small class="text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Document Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="document" class="form-label">Document</label>
                                <input type="file" class="form-control @error('document') is-invalid @enderror"
                                       id="document" name="document" accept=".pdf,.doc,.docx">
                                <small class="text-muted">Max size: 2MB. Formats: PDF, DOC, DOCX</small>
                                @error('document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror"
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
