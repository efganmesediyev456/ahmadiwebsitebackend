@extends('backend.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Kategoriyanı Düzəliş Et</h4>
                <a href="{{ route('admin.service-category.index') }}" class="btn btn-success">
                    <i class="fas fa-arrow-left"></i> Geriyə qayıt
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.service-category.update', $serviceCategory) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($languages as $language)
                            <li class="nav-item">
                                <button type="button" class="nav-link @if($loop->first) active @endif"
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
                                    <label>Başlıq ({{ $language->code }})</label>
                                    <input type="text" name="name[{{ $language->code }}]"
                                           value="{{ old('name.'.$language->code, $serviceCategory->translateOrDefault($language->code)?->name) }}"
                                           class="form-control">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3 mt-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active" @selected(old('status', $serviceCategory->status) === 'active')>Aktiv</option>
                            <option value="inactive" @selected(old('status', $serviceCategory->status) === 'inactive')>Passiv</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fas fa-sync-alt"></i> Yenilə
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
