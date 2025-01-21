import sys
import json
import pickle
import os
import warnings
warnings.filterwarnings('ignore')  # Suppress all warnings

try:
    # Get the directory where the script is located
    script_dir = os.path.dirname(os.path.abspath(__file__))

    # Load the model and scaler using absolute paths
    model_path = os.path.join(script_dir, 'Parkinsons_Disease.pkl')
    scaler_path = os.path.join(script_dir, 'Parkinsons_Disease_Scaler.pkl')

    with open(model_path, 'rb') as model_file:
        model = pickle.load(model_file)

    with open(scaler_path, 'rb') as scaler_file:
        scaler = pickle.load(scaler_file)

    # Read input data from Laravel
    input_data = json.loads(sys.argv[1])

    # Extract features in the correct order
    features = [
        float(input_data['MDVP_Fo_Hz']),
        float(input_data['MDVP_Fhi_Hz']),
        float(input_data['MDVP_Flo_Hz']),
        float(input_data['MDVP_Jitter']),
        float(input_data['MDVP_Jitter_Abs']),
        float(input_data['MDVP_RAP']),
        float(input_data['MDVP_PPQ']),
        float(input_data['Jitter_DDP']),
        float(input_data['MDVP_Shimmer']),
        float(input_data['MDVP_Shimmer_dB']),
        float(input_data['Shimmer_APQ3']),
        float(input_data['Shimmer_APQ5']),
        float(input_data['MDVP_APQ']),
        float(input_data['Shimmer_DDA']),
        float(input_data['NHR']),
        float(input_data['HNR']),
        float(input_data['RPDE']),
        float(input_data['DFA']),
        float(input_data['spread1']),
        float(input_data['spread2']),
        float(input_data['D2']),
        float(input_data['PPE'])
    ]

    # Preprocess the input and predict
    scaled_features = scaler.transform([features])
    prediction = model.predict(scaled_features)

    # Output only the prediction result
    print("Positive" if prediction[0] == 1 else "Negative")
    sys.stdout.flush()

except Exception as e:
    print(f"Error: {str(e)}")
    sys.exit(1)
