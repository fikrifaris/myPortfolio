@extends('layouts.app')

@section('content')
    <!-- Speciality -->
    <section id="home-a" class="text-center">
        <div class="container">
            <h2 class="section-title">I Specialize In</h2>
            <div class="bottom-line"></div>
            <p class="lead">
                Web Development mainly the front-end side, creating standard layout with clean website designs.
            </p>
            <div class="specials">
                <div>
                    <i class="fas fa-file-alt fa-2x"></i>
                    <h3>Concepting</h3>
                    <p>
                        Designing a website with a modern or trending layout.
                    </p>
                </div>
                <div>
                    <i class="fas fa-desktop fa-2x"></i>
                    <h3>Responsive Pages</h3>
                    <p>
                        A website that fits on all devices without compromising the layout or design.
                    </p>
                </div>
                <div>
                    <i class="fas fa-object-ungroup fa-2x"></i>
                    <h3>Clean Design</h3>
                    <p>
                        "A simple website is a good website"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <!-- Section B: Progress Bars -->
    <section id="about-b" class="bg-grey">
        <div class="container">
            <h2 class="section-title">Technical Skills</h2>
            <div class="bottom-line"></div>
            <h4>HTML & CSS:</h4>
            <div class="progress">
                <div style="width:100%"></div>
            </div>
            <h4>JavaScript:</h4>
            <div class="progress">
                <div style="width:80%"></div>
            </div>
            <h4>PHP Laravel:</h4>
            <div class="progress">
                <div style="width:76%"></div>
            </div>
            <h4>SQL:</h4>
            <div class="progress">
                <div style="width:70%"></div>
            </div>
        </div>
    </section>

    <section class="contact-info bg-dark">
        <div class="container">
            <div class="box">
                <i class="fas fa-phone fa-3x"></i>
                <h3>Phone Number</h3>
                <p>8142067</p>
            </div>
            <div class="box">
                <i class="fas fa-envelope fa-3x"></i>
                <h3>Email Address</h3>
                <p>fikri.faris@hotmail.com</p>
            </div>
        </div>
    </section>
@endsection
