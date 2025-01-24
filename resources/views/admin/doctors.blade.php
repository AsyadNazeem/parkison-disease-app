@extends('admin.admin_layout')

@section('content')

    <h1>Registered Doctors</h1>

    @if($doctors->isEmpty())
        <p>No doctors have registered yet.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>License Number</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($doctors as $index => $doctor)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $doctor->name }}
                        @if($doctor->created_at->diffInDays(now()) <= 7)
                            <span class="badge bg-success">New</span>
                        @endif
                    </td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ ucfirst($doctor->role) }}</td>
                    <td>
                        @if($doctor->license_number)
                            <a href="{{ asset($doctor->license_number) }}" target="_blank">View Document</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($doctor->status === 'approved')
                            <span class="badge bg-primary">Approved</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.doctors.toggleStatus', $doctor->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-warning">
                                {{ $doctor->status === 'approved' ? 'Deactivate' : 'Approved' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
