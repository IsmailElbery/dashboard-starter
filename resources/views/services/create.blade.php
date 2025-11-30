@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('messages.create_service') }}</span>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.back_to_list') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('partials.alerts')

                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Title (English) -->
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">{{ __('messages.title') }} (English) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Title (Arabic) -->
                            <div class="col-md-6 mb-3">
                                <label for="title_ar" class="form-label">{{ __('messages.title') }} (العربية)</label>
                                <input type="text" class="form-control @error('title_ar') is-invalid @enderror"
                                       id="title_ar" name="title_ar" value="{{ old('title_ar') }}" dir="rtl">
                                @error('title_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description (English) -->
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('messages.description') }} (English) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description (Arabic) -->
                        <div class="mb-3">
                            <label for="description_ar" class="form-label">{{ __('messages.description') }} (العربية)</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror"
                                      id="description_ar" name="description_ar" rows="4" dir="rtl">{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Order -->
                            <div class="col-md-6 mb-3">
                                <label for="order" class="form-label">{{ __('messages.order') }} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       id="order" name="order" value="{{ old('order', 0) }}" required min="0">
                                <small class="text-muted">{{ __('messages.lower_numbers_first') }}</small>
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Photo Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                       id="photo" name="photo" accept="image/*">
                                <small class="text-muted">{{ __('messages.max_file_size') }}</small>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Is Active Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active"
                                       name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    {{ __('messages.active_service') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('services.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('messages.create_service') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
