
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="mb-4">
        <h4 class="fw-bold">Edit Departemen</h4>
        <p class="text-muted mb-0">Perbarui informasi departemen.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('departments.update', $department) }}" method="POST">
                @csrf
                @method('PUT')
                @include('departments._form')
            </form>
        </div>
    </div>
</div>
@endsection
