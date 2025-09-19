@extends('backend.layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Company Abouts</h4>
            @if(\App\Models\CompanyAbout::count()<4)
            <a href="{{ route('admin.company_abouts.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Yenisini yarat
            </a>
            @endif
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
