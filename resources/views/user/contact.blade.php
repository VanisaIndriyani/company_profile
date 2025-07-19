@extends('layouts.user')

@section('header')
    <style>
        #hero{
            background: url('{{asset('user/images/contact.png')}}') top center;
            background-repeat: no-repeat;
            width:100%;
            background-size:cover;
        }
    </style>
@endsection

@section('hero')
    <h1>Fourjoo</h1>
    <h2>Bergabung dan liburan bersama Kami</h2>
@endsection

@section('content')

  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="section-header">
        <h3 class="section-title">Contact</h3>
        <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
      </div>
    </div>

    {{-- <div id="google-map" data-latitude="40.713732" data-longitude="-74.0092704"></div> --}}

    <div class="container wow fadeInUp">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 mb-4">
          <div class="form bg-white p-4 rounded shadow-sm">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="{{ route('contact.send') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label for="name">Your Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group mb-3">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group mb-3">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group mb-3">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit" class="btn btn-primary px-4">Send Message</button></div>
            </form>
            @if(session('success'))
              <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
          <div class="contact-info-box bg-white p-4 rounded shadow-sm text-center mx-auto" style="max-width:500px;">
            <div class="mb-4">
              <div class="d-flex align-items-center justify-content-center mb-3">
                <span style="font-size:2rem;color:#2ecc71;" class="mr-3"><i class="fa fa-map-marker"></i></span>
                <span class="text-left">Gedong Tengen,<br>Daerah Istimewa Yogyakarta</span>
              </div>
              <div class="d-flex align-items-center justify-content-center mb-3">
                <span style="font-size:2rem;color:#2ecc71;" class="mr-3"><i class="fa fa-envelope"></i></span>
                <span class="text-left">danyadhi4149@gmail.com</span>
              </div>
              <div class="d-flex align-items-center justify-content-center mb-3">
                <span style="font-size:2rem;color:#2ecc71;" class="mr-3"><i class="fa fa-phone"></i></span>
                <span class="text-left">0831-6179-3990</span>
              </div>
            </div>
            <div class="social-links d-flex justify-content-center gap-2 mt-3">
              <a href="#" class="d-flex align-items-center justify-content-center rounded-circle mr-2" style="width:44px;height:44px;background:#222;color:#fff;font-size:1.4rem;"><i class="fa fa-twitter"></i></a>
              <a href="#" class="d-flex align-items-center justify-content-center rounded-circle mr-2" style="width:44px;height:44px;background:#222;color:#fff;font-size:1.4rem;"><i class="fa fa-facebook"></i></a>
              <a href="#" class="d-flex align-items-center justify-content-center rounded-circle mr-2" style="width:44px;height:44px;background:#222;color:#fff;font-size:1.4rem;"><i class="fa fa-instagram"></i></a>
              <a href="#" class="d-flex align-items-center justify-content-center rounded-circle mr-2" style="width:44px;height:44px;background:#222;color:#fff;font-size:1.4rem;"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="d-flex align-items-center justify-content-center rounded-circle" style="width:44px;height:44px;background:#222;color:#fff;font-size:1.4rem;"><i class="fa fa-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- #contact -->
@endsection
