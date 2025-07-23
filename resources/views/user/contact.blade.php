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
                <span style="font-size:2rem;color:#25D366;" class="mr-3"><i class="fa fa-whatsapp"></i></span>
                <span class="text-left">
                  <a href="https://wa.me/6282177760504" target="_blank" style="color:#25D366;font-weight:bold;text-decoration:none;">082177760504</a>
                </span>
              </div>
              <div class="d-flex align-items-center justify-content-center mb-3">
                <span style="font-size:2rem;color:#ea4335;" class="mr-3"><i class="fa fa-envelope"></i></span>
                <span class="text-left">
                  <a href="mailto:coffefourjo@gmail.com" style="color:#ea4335;font-weight:bold;text-decoration:none;">coffefourjo@gmail.com</a>
                </span>
              </div>
              <div class="d-flex align-items-center justify-content-center mb-3">
                <span style="font-size:2rem;color:#C13584;" class="mr-3"><i class="fa fa-instagram"></i></span>
                <span class="text-left">
                  <a href="https://instagram.com/vapefourjo" target="_blank" style="color:#C13584;font-weight:bold;text-decoration:none;">@vapefourjo</a>
                  &nbsp;|&nbsp;
                  <a href="https://instagram.com/fourjo_coffee" target="_blank" style="color:#C13584;font-weight:bold;text-decoration:none;">@fourjo_coffee</a>
                </span>
              </div>
            </div>
            <div class="social-links d-flex justify-content-center gap-2 mt-3">
              <a href="https://wa.me/6282177760504" class="d-flex align-items-center justify-content-center rounded-circle mr-2" style="width:44px;height:44px;background:#25D366;color:#fff;font-size:1.4rem;" target="_blank"><i class="fa fa-whatsapp"></i></a>
              <a href="mailto:coffefourjo@gmail.com" class="d-flex align-items-center justify-content-center rounded-circle mr-2" style="width:44px;height:44px;background:#ea4335;color:#fff;font-size:1.4rem;"><i class="fa fa-envelope"></i></a>
              <a href="https://instagram.com/vapefourjo" class="d-flex align-items-center justify-content-center rounded-circle mr-2" style="width:44px;height:44px;background:#C13584;color:#fff;font-size:1.4rem;" target="_blank"><i class="fa fa-instagram"></i></a>
              <a href="https://instagram.com/fourjo_coffee" class="d-flex align-items-center justify-content-center rounded-circle" style="width:44px;height:44px;background:#C13584;color:#fff;font-size:1.4rem;" target="_blank"><i class="fa fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- #contact -->
@endsection
