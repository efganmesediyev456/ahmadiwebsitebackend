@extends('backend.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>{{ $socialLink ? 'Social Link Düzəliş Et' : 'Yeni Social Link Yarat' }}</h4>
                <a href="{{ route('admin.social-link.index') }}" class="btn btn-success">
                    <i class="fas fa-arrow-left"></i> Geriyə qayıt
                </a>
            </div>

            <div class="card-body">
                <form action="{{ $socialLink ? route('admin.social-link.update', $socialLink->id) : route('admin.social-link.store') }}"
                      method="POST"
                      id="saveForm"
                      enctype="multipart/form-data">
                    @csrf
                    @if($socialLink)
                        @method('PUT')
                    @endif

                    {{-- Dil tabları --}}
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($languages as $language)
                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link @if($loop->first) active @endif"
                                        data-bs-toggle="tab"
                                        data-bs-target="#{{ $language->code }}">
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
                                    <input type="text"
                                           name="translations[{{ $language->code }}][title]"
                                           value="{{ old('translations.'.$language->code.'.title', $socialLink->translations->where('locale', $language->code)->first()->title ?? '') }}"
                                           class="form-control">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>URL</label>
                            <input type="text" name="url" value="{{ old('url', $socialLink->url ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sıra</label>
                            <input type="number" name="order" value="{{ old('order', $socialLink->order ?? 0) }}" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Şəkil</label>
                        <input type="file" name="image" class="form-control">
                        @if(!empty($socialLink?->image))
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$socialLink->image) }}" alt="Image" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active" @selected(old('status', $socialLink->status ?? 'active') === 'active')>Aktiv</option>
                            <option value="inactive" @selected(old('status', $socialLink->status ?? '') === 'inactive')>Passiv</option>
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
