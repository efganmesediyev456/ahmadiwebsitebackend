@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Banner</h4>
        </div>
        <div class="card-body">
            <form id="saveForm" action="{{ route('admin.banner.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="nav nav-tabs">
                    @foreach($languages as $language)
                    <li class="nav-item">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                data-bs-toggle="tab" 
                                data-bs-target="#{{ $language->code }}" 
                                type="button">
                            {{ $language->title }}
                        </button>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content mt-3">
                    @foreach($languages as $language)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $language->code }}">
                        <div class="mb-3">
                            <label class="form-label">Başlıq ({{ $language->code }})</label>
                            <input type="text" class="form-control" 
                                   name="title[{{ $language->code }}]"
                                   value="{{ $item->getTranslation($language->code)?->title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alt Başlıq ({{ $language->code }})</label>
                            <input type="text" class="form-control" 
                                   name="subtitle[{{ $language->code }}]"
                                   value="{{ $item->getTranslation($language->code)?->subtitle }}">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner url</label>
                    <input type="text" name="banner_url" class="form-control" value="{{ $item->banner_url }}">
                    
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Yadda Saxla
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
