@extends('backend.layouts.layout')

@section('content')
    <style>
        img {
            max-height: 100px;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Sayt Parametrləri</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update', $item->id) }}" method="POST" id="saveForm"
                    enctype="multipart/form-data">
                    @method('PUT')

                    <ul class="nav nav-tabs" id="languageTabs" role="tablist">

                        @foreach ($languages as $language)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if ($loop->iteration == 1) active @endif"
                                    id="{{ $language->code }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#{{ $language->code }}" type="button" role="tab"
                                    aria-controls="{{ $language->code }}" aria-selected="true">{{ $language->title }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content mt-3" id="languageTabsContent">
                        @foreach ($languages as $language)
                            <div class="tab-pane fade show @if ($loop->iteration == 1) active @endif"
                                id="{{ $language->code }}" role="tabpanel" aria-labelledby="{{ $language->code }}-tab">

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address
                                        {{ $language->code }}</label>
                                    <input type="text" class="form-control" name="address[{{ $language->code }}]"
                                        id="address[{{ $language->code }}]" placeholder="Daxil edin"
                                        value="{{ $item->translate($language->code)?->address }}">
                                </div>

                                 <div class="mb-3">
                                    <label for="terms_and_conditions" class="form-label">Terms and conditions
                                        {{ $language->code }}</label>
                                    <input type="text" class="form-control" name="terms_and_conditions[{{ $language->code }}]"
                                        id="terms_and_conditions[{{ $language->code }}]" placeholder="Daxil edin"
                                        value="{{ $item->translate($language->code)?->terms_and_conditions }}">
                                </div>

                                <div class="mb-3">
                                    <label for="start_a_project_url" class="form-label">Start a project
                                        {{ $language->code }}</label>
                                    <input type="text" class="form-control" name="start_a_project_url[{{ $language->code }}]"
                                        id="start_a_project_url[{{ $language->code }}]" placeholder="Daxil edin"
                                        value="{{ $item->translate($language->code)?->start_a_project_url }}">
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="map" class="form-label">Map</label>
                                <input type="text" name="map" class="form-control"
                                    value="{{ $item->map }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="whats_app" class="form-label">Whats app</label>
                                <input type="text" name="whats_app" class="form-control"
                                    value="{{ $item->whats_app }}">
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telegram" class="form-label">Telegram</label>
                                <input type="text" name="telegram" class="form-control"
                                    value="{{ $item->telegram }}">
                            </div>
                        </div>

                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="header_logo" class="form-label">Header Logo</label>
                                <input type="file" name="header_logo" class="form-control">
                                <small class="text-muted d-block my-2">Tövsiyə olunan ölçü: 160x50 piksel</small>

                                @if ($item->header_logo)
                                    <img width="300" src="{{ '/storage/' . $item->header_logo }}" alt="Header Logo">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="favicon" class="form-label">Favicon</label>
                                <input type="file" name="favicon" class="form-control">
                                @if ($item->favicon)
                                    <img width="64" src="{{ '/storage/' . $item->favicon }}" alt="Favicon">
                                @endif
                            </div>
                        </div>

                        

                    </div>

                    <div class="row mt-2">
                        <div class="d-flex justify-content-end">
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">
                                    <i class="fas fa-save"></i>
                                    <span>Yadda saxla</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
