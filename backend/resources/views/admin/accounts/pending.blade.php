@extends('layouts.app')
@section('title', 'Pending Accounts')

@section('content')
<div class="page-wrapper">
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4>Pending Accounts</h4>
                <h6>Approve or reject new accounts</h6>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr><th>Name</th><th>Email</th><th>Type</th><th>Business</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $u)
                            <tr>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->role == 2 ? 'Warehouse' : 'Shop' }}</td>
                                <td>{{ $u->vendor?->warehouse_name ?? $u->shop?->shop_name }}</td>
                                <td>
                                    <form method="POST" action="/admin/accounts/{{ $u->id }}/approve" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form method="POST" action="/admin/accounts/{{ $u->id }}/reject" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No pending accounts</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection