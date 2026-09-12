@extends('layouts.app')

@section('title', 'Edit Product - ' . $product->name)
@section('page-header', 'Edit Product')

@section('content')
<div class="container-fluid p-0" style="max-width: 960px;">

    <!-- Breadcrumb Nav -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none text-muted">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.show', $product) }}" class="text-decoration-none text-muted">{{ Str::limit($product->name, 20) }}</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="card-custom p-4 p-md-5">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
            <div>
                <h4 class="fw-bold text-dark mb-1">Edit Product</h4>
                <p class="text-muted m-0 fs-7">Update specifications, pricing, inventory stock level, or replace product image.</p>
            </div>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Details
            </a>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Left Column: Image Upload & Preview -->
                <div class="col-12 col-md-4 text-center">
                    <label class="form-label fw-bold text-dark d-block text-start mb-2">Product Image</label>
                    <div class="border rounded-4 p-3 bg-light text-center position-relative mb-3">
                        <img id="imagePreview" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height: 220px; width: 100%; object-fit: cover;">
                        <p class="text-muted mb-2" style="font-size: 0.8rem;">Upload new photo to replace current image</p>
                    </div>

                    <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewSelectedImage(this)">
                    @error('image')
                        <div class="invalid-feedback text-start d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Right Column: Product Form Inputs -->
                <div class="col-12 col-md-8">
                    <div class="row g-3">
                        <!-- Product Name -->
                        <div class="col-12">
                            <label for="name" class="form-label fw-bold text-dark">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Ergonomic Office Chair" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-12 col-sm-6">
                            <label for="category" class="form-label fw-bold text-dark">Category <span class="text-danger">*</span></label>
                            <input type="text" name="category" id="category" list="categoryOptions" class="form-control @error('category') is-invalid @enderror" placeholder="Select or type category..." value="{{ old('category', $product->category) }}" required>
                            <datalist id="categoryOptions">
                                @foreach($existingCategories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="col-12 col-sm-6">
                            <label for="price" class="form-label fw-bold text-dark">Price ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted fw-bold">$</span>
                                <input type="number" name="price" id="price" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price', $product->price) }}" required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="col-12 col-sm-6">
                            <label for="quantity" class="form-label fw-bold text-dark">Quantity in Stock <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" min="0" class="form-control @error('quantity') is-invalid @enderror" placeholder="0" value="{{ old('quantity', $product->quantity) }}" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label for="description" class="form-label fw-bold text-dark">Product Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Provide a detailed description of features...">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Submit Buttons -->
                <div class="col-12 pt-3 border-top d-flex justify-content-end gap-3">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-light border px-4 py-2 rounded-3 text-secondary fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-gradient-primary px-4 py-2 rounded-3 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function previewSelectedImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
