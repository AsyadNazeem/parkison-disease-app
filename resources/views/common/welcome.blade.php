@extends('layout.app')

@section('content')

    <!-- Main Content -->
    <main class="container my-5">
        <div class="container-common">
            <h1 class="website-name">Parkinson <span>Detection</span> App</h1>
            <p class="text-center">Empowering early diagnosis and better healthcare for Parkinson's patients.</p>

            <!-- Latest Blog Posts Section -->
            <section class="mt-5">
                <h2 class="text-center">Latest Insights</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <img src="{{ asset('assets/images/lucas-vasques-9vnACvX2748-unsplash.jpg') }}" class="card-img-top" alt="Medical Research">
                            <div class="card-body">
                                <h5 class="card-title">Understanding Parkinson's Symptoms</h5>
                                <p class="card-text">Early detection is key! Learn about the first signs of Parkinson’s and how to seek timely medical help.</p>
                                <a href="#" class="btn btn-primary" style="color: white">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <img style="height: 420px" src="{{ asset('assets/images/natasha-connell-aCU6AJnT-8g-unsplash.jpg') }}" class="card-img-top" alt="Brain Health">
                            <div class="card-body">
                                <h5 class="card-title">Advancements in Parkinson’s Diagnosis</h5>
                                <p class="card-text">AI-powered tools are revolutionizing the way we detect Parkinson’s disease. Find out how.</p>
                                <a href="#" class="btn btn-primary" style="color: white">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quick Diagnosis Section -->
            <section class="mt-5 text-center">
                <h2>Start Your Parkinson's Risk Assessment</h2>
                <p>Answer a few simple questions and get an early risk analysis.</p>
                <a href="{{ route('index.register') }}" class="btn btn-success btn-lg" style="color: white">Take the Test</a>
            </section>

            <!-- Testimonials Section -->
            <section class="mt-5">
                <h2 class="text-center">What Our Users Say</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card p-3">
                            <p>“This app helped me detect early signs of Parkinson’s in my father. The test was easy and the reports were detailed.”</p>
                            <strong>- Sarah Thompson</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-3">
                            <p>“A revolutionary tool! The AI-based predictions are amazing and it has given us so much clarity.”</p>
                            <strong>- Dr. James Carter</strong>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call to Action -->
            <section class="mt-5 text-center">
                <h2>Join Our Community</h2>
                <p>Connect with other patients, doctors, and researchers.</p>
                <a href="{{ route('index.register') }}" class="btn btn-outline-primary btn-lg">Sign Up</a>
            </section>
        </div>
    </main>

@endsection
