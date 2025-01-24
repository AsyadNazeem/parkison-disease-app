@extends('admin.admin_layout')

@section('content')

    <h1>Admin List</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            @if(auth()->user()->role === 'superadmin') {{-- Show only for super admins --}}
            <th>Status</th>
            <th>Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ ucfirst($admin->role) }}</td>
                @if(auth()->user()->role === 'superadmin') {{-- Show only for super admins --}}
                <td>{{ $admin->status === 'active' ? 'Active' : 'Inactive' }}</td>
                <td>
                    <form action="{{ route('admin.update.status', $admin->id) }}" method="POST" class="status-form">
                        @csrf
                        @method('PUT')
                        <button type="button" class="btn btn-sm btn-{{ $admin->status === 'active' ? 'danger' : 'success' }} status-btn">
                            {{ $admin->status === 'active' ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection


    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



