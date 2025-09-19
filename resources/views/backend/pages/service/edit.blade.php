@extends('backend.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ $service ? 'Xidməti Düzəliş Et' : 'Yeni Xidmət Yarat' }}</h4>
                <a href="{{ route('admin.service.index') }}" class="btn btn-success">
                    <i class="fas fa-arrow-left"></i> Geriyə qayıt
                </a>
            </div>

            <div class="card-body">
                <form action="{{ $service ? route('admin.service.update', ['service' => $service->id]) : route('admin.service.store') }}" method="POST">
                    @csrf
                    @if($service)
                        @method('PATCH')
                    @endif

                    {{-- Kategoriya --}}
                    <div class="mb-3">
                        <label>Kategoriya</label>
                        <select name="category_id" class="form-control">
                            <option value="">Seçin</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @selected((old('category_id') ?? $service?->category_id) == $category->id)>
                                    {{ $category->translations->firstWhere('locale', app()->getLocale())->title ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Translation Tabs --}}
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
                            @php
                                $locale = $language->code;
                                $translation = $service ? $service->translations->firstWhere('locale', $locale) : null;
                            @endphp
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $locale }}">
                                <div class="mb-3">
                                    <label>Başlıq ({{ $locale }})</label>
                                    <input type="text" name="title[{{ $locale }}]"
                                           value="{{ old('title.'.$locale) ?? $translation?->title }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Təsvir ({{ $locale }})</label>
                                    <textarea name="description[{{ $locale }}]" class="form-control ckeditor" rows="5">{{ old('description.'.$locale) ?? $translation?->description }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Status --}}
                    <div class="mb-3 mt-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active" @selected((old('status') ?? $service?->status) === 'active')>Aktiv</option>
                            <option value="inactive" @selected((old('status') ?? $service?->status) === 'inactive')>Passiv</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">
                        <i class="fas fa-save"></i> Yadda saxla
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.ckeditor').forEach(el => {
                ClassicEditor.create(el).catch(error => { console.error(error); });
            });
        });
    </script>
@endsection
