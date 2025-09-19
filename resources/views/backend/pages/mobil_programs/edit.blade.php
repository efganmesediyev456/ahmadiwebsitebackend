@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Mobil Program Düzəliş</h4>
            <a href="{{ route('admin.mobil_programs.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form id="saveForm" action="{{ route('admin.mobil_programs.update', $mobilProgram->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Şəkil</label>
                    <input type="file" class="form-control" name="image">
                    @if($mobilProgram->image)
                        <img src="/storage/{{ $mobilProgram->image }}" class="mt-2 img-thumbnail" width="120">
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Tərəf</label>
                    <select name="left_or_right" class="form-control">
                        <option value="0" @if($mobilProgram->left_or_right == 0) selected @endif>Sol</option>
                        <option value="1" @if($mobilProgram->left_or_right == 1) selected @endif>Sağ</option>
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
                                    value="{{ $mobilProgram->translate($language->code)?->url }}"
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
