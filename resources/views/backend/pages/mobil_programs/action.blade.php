<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="mobilProgramActionDropdown{{ $row->id }}"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cog"></i>
    </button>

    <ul class="dropdown-menu" aria-labelledby="mobilProgramActionDropdown{{ $row->id }}">
        {{-- Redaktə --}}
        <li>
            <a class="dropdown-item" href="{{ route('admin.mobil_programs.edit', $row->id) }}">
                <i class="fas fa-edit text-primary me-2"></i> Redaktə
            </a>
        </li>

        {{-- Sil --}}
        <li>
            <form action="{{ route('admin.mobil_programs.destroy', $row->id) }}" method="POST"
                  class="d-inline delete-form"
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
