@extends('layouts.user')

@section('header')
    <style>
        #hero{
            background: url('{{asset('user/images/coffeshop_layout.jpg')}}') top center;
            background-repeat: no-repeat;
            width:100%;
            background-size:cover;
        }
        .form-control:focus {
          box-shadow: none;
        }

        .form-control::placeholder {
          font-size: 0.95rem;
          color: #aaa;
          font-style: italic;
        }
        .article{
          line-height: 1.6;
          font-size: 15px;
        }
    </style>
@endsection

@section('hero')
    <h1>Blog Mengenai Coffe Shop</h1>
    <h2>Kumpulan artikel-artikel mengenai perkembangan kopi</h2>
@endsection


@section('content')
      <!--========================== Article Section ============================-->
      <section id="about">
        <div class="container wow fadeIn">

          <div class="row">
            <div class="col-9">

              @if (empty(request()->segment(2)) )
                @component('user.component.all_blog', ['articles'=> $articles])
                @endcomponent
              @else
                @component('user.component.single_blog', ['article'=> $articles])
                @endcomponent
              @endif


            </div>
            <div class="col-3">
                <form action="{{route('blog')}}" class="mt-5">
                  <div class="input-group mb-4 border rounded-pill shadow-lg" style="border-radius:10px; box-shadow: 3px 3px 8px grey;">
                    <input type="text" name="s" value="{{Request::get('s')}}" placeholder="Apa yang ingin anda cari?" class="form-control bg-none border-0" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                    <div class="input-group-append border-0">
                      <button type="submit" class="btn text-success"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
                <div class="mb-3 font-weight-bold">Recent Posts</div>
                @foreach ($recents as $recent)
                  <div>
                      @if($recent->slug)
                        <a href="{{ route('blog.show', ['slug' => $recent->slug]) }}">
                          <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                          {{ $recent->title }}
                        </a>
                      @else
                        <span>
                          <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                          {{ $recent->title }}
                        </span>
                      @endif
                      <hr>
                  </div>
                @endforeach
            </div>
          </div>

        </div>
      </section><!-- #services -->

<!-- Modal Show Blog -->
<div class="modal fade" id="blogShowModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background:#1976d2;color:#fff;">
        <h5 class="modal-title">Detail Blog</h5>
        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  $(document).on('click', '.btn-show-blog', function(e) {
    e.preventDefault();
    var url = $(this).data('url');
    $('#blogShowModal .modal-body').html('<div class="text-center py-5"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
    $('#blogShowModal').modal('show');
    $.get(url, function(res) {
      $('#blogShowModal .modal-body').html(res);
    });
  });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
