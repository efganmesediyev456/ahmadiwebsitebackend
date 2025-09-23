@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Who We Do Item Düzəliş Et</h4>
            <a href="{{ route('admin.whoWeDoItem.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.whoWeDoItem.update', $whoWeDoItem->id) }}" method="POST" id="saveForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Who We Do</label>
                    <select name="who_we_do_id" class="form-control">
                        <option value="">Seçin</option>
                        @foreach($whoWeDos as $whoWeDo)
                            <option value="{{ $whoWeDo->id }}" 
                                    @if($whoWeDoItem->who_we_do_id == $whoWeDo->id) selected @endif>
                                {{ $whoWeDo->translate(app()->getLocale())?->title }}
                            </option>
                        @endforeach
                    </select>
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
                                <label>Title ({{ $language->code }})</label>
                                <input type="text" name="title[{{ $language->code }}]" 
                                       value="{{ $whoWeDoItem->translate($language->code)?->title }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Description ({{ $language->code }})</label>
                                <textarea name="description[{{ $language->code }}]" class="form-control" rows="4">{{ $whoWeDoItem->translate($language->code)?->description }}</textarea>
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
