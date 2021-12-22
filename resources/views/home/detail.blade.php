@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')




<!-- main-slider -->
<section class="w3l-blog" >
  <div class="text-element-9">
    <div class="row no-gutters">

      <a class="col-lg-6 order-2 blog-article-posts ">
      <div class="blog-post d-flex flex-wrap align-content-between">
        <div class="post-content">
          <ul class="author-date mb-4 d-flex align-items-center">
            <li class="circle-lg avatar"><img src="{{asset('assets/images/categories/'.$petition->image)}}" alt=""></li>
            
            <li><span class="fa fa-clock-o" aria-hidden="true"></span> {{$petition->date_added}}</li>
          </ul>
          <h4 class="blog_post_title mb-4">{{$petition->title}}</h4>
            <p class="sub-para"><?=$petition->description?></p>
        
        </div>
      
      </div>
    </a>
    </div>
  </div>
</section>

<section id="author" class="w3l-author py-5">
    <div class="container py-lg-3">
        <div class="row align-items-center">
            @if(count($signatures) > 0)
            <div class="col-lg-6 col-sm-9 order-md-first mt-lg-0 mt-4">
                <h2 class="mt-2 mb-3 title">Signatories</h2>  
                <br>
                @foreach($signatures as $signature)
                <div>
                   <span class="category">Digitaly Signed By {{ $signature->name }}</span>
                   <p>{{ $signature->text}}</p>
                    <ul>
                      <li>Date {{ $signature->added_on }}</li>
                    </ul>
                    <br>
                </div>
                @endforeach
                  
            </div>
            @endif
            @if($check == false)
            <div class="col-lg-6 col-sm-9 order-md-first mt-lg-0 mt-4">
              <section class="w3l-contact" id="contact">
                <h2 class="mt-2 mb-3 title">Add Signature</h2>  
                @if(\Session::has('flash_message_error'))

                <div class="alert alert-danger">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{!! session('flash_message_error') !!}</strong>

                </div>

                @endif

                @if(\Session::has('flash_message_success'))

                <div class="alert alert-success">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{!! session('flash_message_success') !!}</strong>

                </div>

                @endif

                <form action="{{url('add-signature')}}" method="post" class="">
                {{ csrf_field() }}
                <input type="hidden" name="petition_id" value="{{$petition->id}}">
                <div class="main-input">
                  <textarea class="contact-textarea contact-input" name="text" placeholder="Enter your message" required=""></textarea>
                </div>
                <div class="text-right">
                  <button class="btn-primary btn theme-button" type="Submit">Submit</button>
                </div>
              </form>
            </section>
            </div>
            @endif
        </div>
    </div>
</section>






@include('layouts.homelayouts.footer')
