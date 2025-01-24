<!DOCTYPE html>
<html>
<head>
    <title>Medical Report #{{ $record->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h1>Medical Report Details</h1>
<table>
    <tr>
        <th>Metric</th>
        <th>Value</th>
    </tr>
    <tr><td>MDVP Fo (Hz)</td><td>{{ $record->MDVP_Fo_Hz }}</td></tr>
    <tr><td>MDVP Fhi (Hz)</td><td>{{ $record->MDVP_Fhi_Hz }}</td></tr>
    <tr><td>MDVP Flo (Hz)</td><td>{{ $record->MDVP_Flo_Hz }}</td></tr>
    <tr><td>MDVP Jitter</td><td>{{ $record->MDVP_Jitter }}</td></tr>
    <tr><td>MDVP Jitter (Abs)</td><td>{{ $record->MDVP_Jitter_Abs }}</td></tr>
    <tr><td>MDVP RAP</td><td>{{ $record->MDVP_RAP }}</td></tr>
    <tr><td>MDVP PPQ</td><td>{{ $record->MDVP_PPQ }}</td></tr>
    <tr><td>Result</td><td>{{ $record->result }}</td></tr>
</table>
</body>
</html>
