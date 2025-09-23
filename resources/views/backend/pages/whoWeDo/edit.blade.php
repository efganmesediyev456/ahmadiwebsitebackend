@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Who We Do Düzəliş Et</h4>
            <a href="{{ route('admin.whoWeDo.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form id="saveForm" action="{{ route('admin.whoWeDo.update', $whoWeDo->id) }}" method="POST">
                @csrf
                @method('PUT')

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
                                <label>Title ({{ $language->code }})</label>
                                <input type="text" name="title[{{ $language->code }}]" 
                                       value="{{ $whoWeDo->translate($language->code)?->title }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Description ({{ $language->code }})</label>
                                <textarea name="description[{{ $language->code }}]" class="form-control" rows="4">{{ $whoWeDo->translate($language->code)?->description }}</textarea>
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
