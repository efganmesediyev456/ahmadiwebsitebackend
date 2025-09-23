<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" 
            id="managementActionDropdown{{ $row->id }}"
            data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cog"></i>
    </button>

    <ul class="dropdown-menu" aria-labelledby="managementActionDropdown{{ $row->id }}">
        <li>
            <a class="dropdown-item" href="{{ route('admin.managements.edit', $row->id) }}">
                <i class="fas fa-edit text-primary me-2"></i> Redaktə
            </a>
        </li>
        <li>
            <form action="{{ route('admin.managements.destroy', $row->id) }}" method="POST"
                  class="d-inline delete-form"
                  onsubmit="return confirm('Silmək istədiyinizə əminsiniz?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-trash me-2"></i> Sil
                </button>
            </form>
        </li>
    </ul>
</div>
