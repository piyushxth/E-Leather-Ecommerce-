@extends('frontend.layouts.master')
@section('content')
<section class="breadcrumb-section py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
        </nav>
    </div>
</section>
<section class="contact-info custom-margin">
    <div class="container">
        <div class="page-title">
            <h1 class="main-heading">Contact us</h1>
        </div>
        <div class="row gy-4 ">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="address">
                    <div class=" contact-item">
                        <i class="fas fa-location-arrow"></i>
                        <h2>Address</h2>
                        <span>{{ $setting_com->address }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tell">

                    <div class=" contact-item">
                        <i class="fas fa-mobile"></i>
                        <h2>Mobile</h2>
                        <span>{!! getClickableLinks($setting_com->mobile_number, "phone") !!}</span>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="mail">

                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <h2>Email</h2>
                        <span>{!! getClickableLinks($setting_com->email, "email") !!}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-form-google custom-margin">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="contact-form">
                    <div class="heading">
                        <h2>DROP US A MESSAGE</h2>
                    </div>
                    <form action="{{route('contact_details') }}" id="homecontact_form" method="POST">
                        @csrf
                        <div class="pt-3">
                            <label for="name">Name*</label><br>
                            <input type="text" name="name" id="name"><br>
                            <span class="error-message pt-3 text-danger"></span>
                        </div>
                        <div class="pt-3">
                            <label for="contact">Contact*</label><br>
                            <input type="number" name="contact" id="contact"><br>
                            <span class="error-message pt-3 text-danger"></span>
                        </div>
                        <div class="pt-3">
                            <label for="email">Email*</label><br>
                            <input type="email" name="email" id="email"><br>
                            <span class="error-message pt-3 text-danger"></span>
                        </div>
                        <div class="pt-3">
                            <label for="message">Message</label><br>
                            <textarea name="message" id="message" cols="30" rows="4"></textarea>
                        </div>
                        <div class="submit-button "><button type="submit" class="send_message_btn"> <i class="fas pe-3 fa-paper-plane"></i>Send Message</button></div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-7-lg">
                <div class="google-map">
                    {!! ($setting_com->google_map) !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection