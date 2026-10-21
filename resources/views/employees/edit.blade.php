
@extends('layouts.app')

@section('title', 'Edit Karyawan')
@section('page-title', 'Edit Karyawan')

@section('content')
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Edit Data Karyawan</h4>
        <p class="text-muted mb-0">
            Perbarui informasi {{ $employee->name }}.
        </p>
    </div>

    <div class="content-card">
        <form
            action="{{ route('employees.update', $employee) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            @include('employees._form')
        </form>
    </div>
@endsection
