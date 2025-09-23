@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Şəkil Düzəliş</h4>
            <a href="{{ route('admin.our_studio_galleries.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.our_studio_galleries.update', $ourStudioGallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Şəkil</label>
                    <input type="file" name="image" class="form-control">
                    @if($ourStudioGallery->image)
                        <img src="{{ asset('storage/' . $ourStudioGallery->image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-save"></i> Yadda saxla
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
