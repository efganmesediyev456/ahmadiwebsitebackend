@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Partner Düzəliş</h4>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form id="saveForm" action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Şəkil</label>
                    <input type="file" name="image" class="form-control">
                    @if($partner->image)
                        <img src="{{ asset('storage/' . $partner->image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <div class="mb-3">
                    <label>Mərtəbə</label>
                    <select name="floor" class="form-control">
                        @for($i=1; $i<=3; $i++)
                            <option value="{{ $i }}" @if($partner->floor==$i) selected @endif>{{ $i }}</option>
                        @endfor
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
                                <label>URL ({{ $language->code }})</label>
                                <input type="text" name="url[{{ $language->code }}]" 
                                       value="{{ $partner->translate($language->code)?->url }}" class="form-control">
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
