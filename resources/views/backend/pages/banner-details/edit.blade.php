@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Banner Detail Düzəliş</h4>
                <div class="buttons">
                    <a href="{{ route('admin.banner-details.index') }}" class="btn btn-success">
                        <i class="fas fa-arrow-left"></i>    
                        Geriyə qayıt
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="saveForm" action="{{ route('admin.banner-details.update', $banner->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                    @foreach($languages as $language)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($loop->first) active @endif"
                            id="{{$language->code}}-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#{{$language->code}}"
                            type="button" role="tab"
                            aria-controls="{{$language->code}}"
                            aria-selected="true">
                            {{$language->title}}
                        </button>
                    </li>
                    @endforeach
                </ul>
                
                <div class="tab-content mt-3" id="languageTabsContent">
                    @foreach($languages as $language)
                    <div class="tab-pane fade show @if($loop->first) active @endif"
                        id="{{$language->code}}" role="tabpanel"
                        aria-labelledby="{{$language->code}}-tab">
                        <div class="mb-3">
                            <label for="title_{{$language->code}}" class="form-label">Başlıq ({{$language->code}})</label>
                            <input type="text" class="form-control"
                                name="title[{{$language->code}}]"
                                id="title_{{$language->code}}"
                                value="{{ $banner->translate($language->code)?->title }}"
                                placeholder="Başlıq daxil edin">
                        </div>


                        <div class="mb-3">
                            <label for="url_{{$language->code}}" class="form-label">Url ({{$language->code}})</label>
                            <input type="text" class="form-control"
                                name="url[{{$language->code}}]"
                                id="url_{{$language->code}}"
                                value="{{ $banner->translate($language->code)?->url }}"
                                placeholder="Banner Detail daxil edin">
                        </div>
                        
                    </div>
                    @endforeach
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
