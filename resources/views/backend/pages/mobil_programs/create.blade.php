@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Yeni Mobil Program Yarat</h4>
            <a href="{{ route('admin.mobil_programs.index') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Geriyə qayıt
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.mobil_programs.store') }}" method="POST" enctype="multipart/form-data" id="saveForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Şəkil</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tərəf</label>
                    <select name="left_or_right" class="form-control">
                        <option value="0">Sol</option>
                        <option value="1">Sağ</option>
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
                                <input type="text" name="url[{{ $language->code }}]" class="form-control">
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
