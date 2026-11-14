@extends('layouts.app')
@section('title', 'Categories')

@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title"><h4>Categories</h4><h6>Add and view product categories</h6></div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <form method="POST" action="/admin/categories" class="row g-2">
                    @csrf
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control" placeholder="Category name" value="{{ old('name') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="parent_id" class="form-select">
                            <option value="">No parent (top level)</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3"><button class="btn btn-primary w-100">Add Category</button></div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead><tr><th>Name</th><th>Slug</th><th>Parent</th></tr></thead>
                        <tbody>
                        @forelse ($categories as $c)
                            <tr>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->slug }}</td>
                                <td>{{ $c->parent?->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No categories yet</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection