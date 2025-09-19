<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
            id="serviceActionDropdown{{ $service->id }}"
            data-bs-toggle="dropdown"
            aria-expanded="false">
        <i class="fas fa-cog"></i>
    </button>

    <ul class="dropdown-menu" aria-labelledby="serviceActionDropdown{{ $service->id }}">
        {{-- Redaktə --}}
        <li>
            <a class="dropdown-item" href="">
                <i class="fas fa-edit text-primary me-2"></i> Redaktə
            </a>
        </li>

        {{-- Status toggle --}}
        <li>
            <form action="" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="{{ $service->status === 'active' ? 'inactive' : 'active' }}">
                <button type="submit" class="dropdown-item">
                    <i class="fas {{ $service->status === 'active' ? 'fa-ban text-warning' : 'fa-check text-success' }} me-2"></i>
                    {{ $service->status === 'active' ? 'Deaktiv Et' : 'Aktiv Et' }}
                </button>
            </form>
        </li>

        {{-- Sil --}}
        <li>
            <form action="" method="POST"
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
