@php
$clients=App\Client::get();
@endphp
<section id="partner-logo" >
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 text-center" style="position: relative;">
        <h2 class="sm-blue-heading">//Partner & Clients</h2>
       
        <div class="clients">
          @foreach($clients as $client)
          <div class=""><a href="{{$client->link}}" target="_blank"><img src="{{ asset('/images/clients/'.$client->image) }}">
          </a></div>
        
          @endforeach
        </div>
        <div class="partner-prev prev"><img src="{{ url('assets/home/images/partner-left-arrow.png')}}"></div>
        <div class="partner-next next" ><img src="{{ url('assets/home/images/partner-right-arrow.png')}}"></div>
     <!--    <div class="partner-prev prev"><img src="images/partner-left-arrow.png"></div>
        <div class="partner-next "><img src="images/partner-right-arrow.png"></div> -->
      </div>
    </div>
  </div>
</section>