@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Portfolio Düzəliş</h4>
            <a href="{{ route('admin.portfolios.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form id="saveForm" action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Şəkil</label>
                    <input type="file" class="form-control" name="image">
                    @if($portfolio->image)
                        <img src="/storage/{{ $portfolio->image }}" class="mt-2 img-thumbnail" width="120">
                    @endif
                </div>

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
                                <label>Slug ({{ $language->code }})</label>
                                <input type="text" name="slug[{{ $language->code }}]"
                                    value="{{ $portfolio->translate($language->code)?->slug }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Başlıq ({{ $language->code }})</label>
                                <input type="text" name="title[{{ $language->code }}]"
                                    value="{{ $portfolio->translate($language->code)?->title }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Sub Başlıq ({{ $language->code }})</label>
                                <input type="text" name="subtitle[{{ $language->code }}]"
                                    value="{{ $portfolio->translate($language->code)?->subtitle }}"
                                    class="form-control">
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
