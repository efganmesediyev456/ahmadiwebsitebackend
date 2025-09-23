@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Yeni Management Üzvü Yarat</h4>
            <a href="{{ route('admin.managements.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.managements.store') }}" method="POST" enctype="multipart/form-data" id="saveForm">
                @csrf

                <div class="mb-3">
                    <label>Şəkil</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label>BE URL</label>
                    <input type="text" name="be_url" class="form-control">
                </div>

                <div class="mb-3">
                    <label>LN URL</label>
                    <input type="text" name="ln_url" class="form-control">
                </div>

                {{-- Dil tabları --}}
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($languages as $language)
                        <li class="nav-item">
                            <button class="nav-link @if($loop->first) active @endif"
                                    data-bs-toggle="tab" data-bs-target="#{{ $language->code }}">
                                {{ $language->title }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content mt-3">
                    @foreach($languages as $language)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $language->code }}">
                            <div class="mb-3">
                                <label>Name ({{ $language->code }})</label>
                                <input type="text" name="name[{{ $language->code }}]" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Position ({{ $language->code }})</label>
                                <input type="text" name="position[{{ $language->code }}]" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Description ({{ $language->code }})</label>
                                <textarea name="description[{{ $language->code }}]" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-save"></i> Yadda saxla
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
