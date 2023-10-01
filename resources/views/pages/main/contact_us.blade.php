@extends("layouts.layout")
@section('content')
  <!-- Content -->
  <div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('assets/images/banner/ban4.jpg') }});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Contact Us</h1>
             </div>
        </div>
    </div>
    
    <div class="content-block">
        <div class="section-area">
            <div class="container">
                <div class="row m-lr0">
                    <div class="col-lg-6 col-md-6 p-lr0 d-flex">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3448.1298878182047!2d-81.38369578541523!3d30.204840081824198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e437ac927a996b%3A0x799695b1a2b970ab!2sNona+Blue+Modern+Tavern!5e0!3m2!1sen!2sin!4v1548177305546" class="align-self-stretch d-flex" style="width:100%; width:100%; min-height: 300px;" allowfullscreen></iframe>
                    </div>
                    <div class="col-lg-6 col-md-6 section-sp2 p-lr30">
                        <form class="contact-bx ajax-form" action="{{ route('contact_request') }}"  method="POST">
                            @csrf
    
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="heading-bx left p-r15">
                                <h2 class="title-head">Get In <span>Touch</span></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page</p>
                            </div>
                            <div class="row placeani">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Your Name</label>
                                            <input name="name" type="text"  class="form-control valid-character">
                                            @error('name')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group"> 
                                            <label>Your Email Address</label>
                                            <input name="email" type="text" class="form-control">
                                            @error('email')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Subject</label>
                                            <input name="subject" type="text"  class="form-control">
                                            @error('subject')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Type Message</label>
                                            <textarea name="message" rows="4" class="form-control"  id="message"></textarea>
                                            @error('message')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-12">
                                    <button name="submit" type="submit" value="Submit" class="ud-btn ud-btn-primary"> Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content END-->
@endsection