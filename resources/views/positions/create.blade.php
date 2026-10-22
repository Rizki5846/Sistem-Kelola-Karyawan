
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="mb-4">
        <h4 class="fw-bold">Tambah Jabatan</h4>
        <p class="text-muted mb-0">Masukkan informasi jabatan baru.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('positions.store') }}" method="POST">
                @csrf
                @include('positions._form')
            </form>
        </div>
    </div>
</div>
@endsection
