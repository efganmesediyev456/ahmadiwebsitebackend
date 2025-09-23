@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Şirkət Haqqında</h4>
        </div>
        <div class="card-body">
            <form id="saveForm" action="{{ route('admin.company_about.update', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label">Content ({{ $language->code }})</label>
                            <textarea class="form-control" name="content[{{ $language->code }}]" rows="3">{{ $item->getTranslation($language->code)?->content }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Content 2 ({{ $language->code }})</label>
                            <textarea class="form-control" name="content2[{{ $language->code }}]" rows="3">{{ $item->getTranslation($language->code)?->content2 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Content 3 ({{ $language->code }})</label>
                            <textarea class="form-control" name="content3[{{ $language->code }}]" rows="3">{{ $item->getTranslation($language->code)?->content3 }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Founded ({{ $language->code }})</label>
                            <input type="text" class="form-control" 
                                   name="founded[{{ $language->code }}]"
                                   value="{{ $item->getTranslation($language->code)?->founded }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Team ({{ $language->code }})</label>
                            <input type="text" class="form-control" 
                                   name="team[{{ $language->code }}]"
                                   value="{{ $item->getTranslation($language->code)?->team }}">
                        </div>
                    </div>
                    @endforeach
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
