@extends('patient.patient_layout')

@section('content')
    <div class="container">
        <h1>Parkinson's Disease Medical Reports</h1>

        @if($medical_records->count() > 0)
            <table class="table table-striped">
                <thead>
                <tr>

                    <th>Report ID</th>
                    <th>Date and Time</th>
                    <th>MDVP Fo (Hz)</th>
                    <th>MDVP Fhi (Hz)</th>
                    <th>Result</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medical_records as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->created_at }}</td>
                        <td>{{ $record->MDVP_Fo_Hz }}</td>
                        <td>{{ $record->MDVP_Fhi_Hz }}</td>
                        <td>{{ $record->result }}</td>
                        <td>
                            <a href="{{ route('download.report', $record->id) }}"
                               class="btn btn-primary btn-sm">
                                Download PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No medical reports found.</p>
        @endif
    </div>
@endsection
