@extends('admin.admin_layout')

@section('content')

    <h1>Registered Patients</h1>

    @if($patients->isEmpty())
        <p>No patients have registered yet.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($patients as $index => $patient)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->phone ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.patients.view', $patient->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
