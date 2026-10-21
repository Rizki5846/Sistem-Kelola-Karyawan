 
@extends('layouts.app')

@section('title', 'Tambah Karyawan')
@section('page-title', 'Tambah Karyawan')

@section('content')
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Tambah Karyawan</h4>
        <p class="text-muted mb-0">
            Masukkan informasi karyawan baru.
        </p>
    </div>

    <div class="content-card">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            @include('employees._form')
        </form>
    </div>
@endsection
