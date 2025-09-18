<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="faqActionDropdown{{ $row->id }}"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cog"></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="faqActionDropdown{{ $row->id }}">
        {{-- Redaktə --}}
        <li>
            <a class="dropdown-item" href="{{ route('admin.banner-details.edit', $row->id) }}">
                <i class="fas fa-edit text-primary me-2"></i> Redaktə
            </a>
        </li>

        {{-- Status Dəyişikliyi --}}
        <li>
            <form action="" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="dropdown-item">
                    <i class="fas {{ $row->is_active ? 'fa-ban text-warning' : 'fa-check text-success' }} me-2"></i>
                    {{ $row->is_active ? 'Deaktiv Et' : 'Aktiv Et' }}
                </button>
            </form>
        </li>

        {{-- Silmə --}}
        <li>
            <form action="{{ route('admin.banner-details.destroy', $row->id) }}" method="POST" class="d-inline delete-form"
                onsubmit="return confirmDelete(event)">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-trash me-2"></i> Sil
                </button>
            </form>
        </li>
    </ul>
</div>