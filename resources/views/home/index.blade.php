@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')




<!-- main-slider -->
<section class="w3l-blog">
  <div class="text-element-9">
    <div class="row no-gutters">
      @foreach($petitions as $petition)

      <a href="{{ url('detail/'.$petition->slug) }}" class="col-lg-6 blog-article-posts bg-color-one">
        <div class="blog-post d-flex flex-wrap align-content-between">
          <div class="post-content">
            <ul class="author-date mb-4 d-flex align-items-center">
              <li class="circle-lg avatar"><img src="{{asset('assets/images/categories/'.$petition->image)}}" alt=""></li>
             
              <li><span class="fa fa-clock-o" aria-hidden="true"></span> {{$petition->date_added}}</li>
            </ul>
        
            <h4 class="blog_post_title mb-4">{{$petition->title}}</h4>
            <p class="sub-para"><?=$petition->description?></p>
           
          </div>
          {{-- <div class="read-button mt-5">Read story <span class="fa fa-long-arrow-right" aria-hidden="true"></span></div> --}}
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>







@include('layouts.homelayouts.footer')
