
@php
    $isEdit = isset($department);
@endphp

<div class="mb-3">
    <label for="name" class="form-label">Nama Departemen <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $department->name ?? '') }}"
           placeholder="Contoh: IT, HRD, Finance" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="description" rows="3"
              class="form-control @error('description') is-invalid @enderror"
              placeholder="Deskripsi departemen (opsional)">{{ old('description', $department->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="is_active" class="form-label">Status</label>
    <select name="is_active" id="is_active" class="form-select" required>
        <option value="1" @selected((string) old('is_active', isset($department) ? (int) $department->is_active : 1) === '1')>Aktif</option>
        <option value="0" @selected((string) old('is_active', isset($department) ? (int) $department->is_active : 1) === '0')>Nonaktif</option>
    </select>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Departemen' }}
    </button>
    <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">
        Batal
    </a>
</div>
