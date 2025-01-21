@extends('layout.app')

@section('content')

<h1>Parkinson Disease Prediction</h1>
<form action="{{ route('parkinson.store') }}" method="POST">
    @csrf
    @if(session('result'))
        <div class="result {{ strtolower(session('result')) === 'positive' ? 'positive' : 'negative' }}">
            Prediction Result: {{ session('result') }}
        </div>
    @endif

    <!-- List all input fields -->
    <label for="MDVP_Fo_Hz">MDVP:Fo(Hz):</label>
    <input type="text" name="MDVP_Fo_Hz" value="197.07600" required><br>

    <label for="MDVP_Fhi_Hz">MDVP:Fhi(Hz):</label>
    <input type="text" name="MDVP_Fhi_Hz" value="206.89600" required><br>

    <label for="MDVP_Flo_Hz">MDVP:Flo(Hz):</label>
    <input type="text" name="MDVP_Flo_Hz" value="192.05500" required><br>

    <label for="MDVP_Jitter">MDVP:Jitter(%):</label>
    <input type="text" name="MDVP_Jitter" value="0.00289" required><br>

    <label for="MDVP_Jitter_Abs">MDVP:Jitter(Abs):</label>
    <input type="text" name="MDVP_Jitter_Abs" value="0.00001" required><br>

    <label for="MDVP_RAP">MDVP:RAP:</label>
    <input type="text" name="MDVP_RAP" value="0.00166" required><br>

    <label for="MDVP_PPQ">MDVP:PPQ:</label>
    <input type="text" name="MDVP_PPQ" value="0.00168" required><br>

    <label for="Jitter_DDP">Jitter:DDP:</label>
    <input type="text" name="Jitter_DDP" value="0.00498" required><br>

    <label for="MDVP_Shimmer">MDVP:Shimmer:</label>
    <input type="text" name="MDVP_Shimmer" value="0.01098" required><br>

    <label for="MDVP_Shimmer_dB">MDVP:Shimmer(dB):</label>
    <input type="text" name="MDVP_Shimmer_dB" value="0.097" required><br>

    <label for="Shimmer_APQ3">Shimmer:APQ3:</label>
    <input type="text" name="Shimmer_APQ3" value="0.00563" required><br>

    <label for="Shimmer_APQ5">Shimmer:APQ5:</label>
    <input type="text" name="Shimmer_APQ5" value="0.00680" required><br>

    <label for="MDVP_APQ">MDVP:APQ:</label>
    <input type="text" name="MDVP_APQ" value="0.00802" required><br>

    <label for="Shimmer_DDA">Shimmer:DDA:</label>
    <input type="text" name="Shimmer_DDA" value="0.01689" required><br>

    <label for="NHR">NHR:</label>
    <input type="text" name="NHR" value="0.00339" required><br>

    <label for="HNR">HNR:</label>
    <input type="text" name="HNR" value="26.775" required><br>

    <label for="RPDE">RPDE:</label>
    <input type="text" name="RPDE" value="0.422229" required><br>

    <label for="DFA">DFA:</label>
    <input type="text" name="DFA" value="0.741367" required><br>

    <label for="spread1">spread1:</label>
    <input type="text" name="spread1" value="-7.3483" required><br>

    <label for="spread2">spread2:</label>
    <input type="text" name="spread2" value="0.177551" required><br>

    <label for="D2">D2:</label>
    <input type="text" name="D2" value="1.743867" required><br>

    <label for="PPE">PPE:</label>
    <input type="text" name="PPE" value="0.085569" required><br>

    <button type="submit">Predict</button>
</form>

@endsection
