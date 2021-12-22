@include('layouts.homelayouts.header')
@include('layouts.homelayouts.nav')




<!-- main-slider -->
<section class="w3l-contact" id="contact">
  	<div class="container py-5">
		<div class="contacts12-main py-md-3">

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

	        @if($errors->any())

	            <div class="alert alert-danger">

	              @foreach($errors->all() as $error)

	                @php $j = (int) filter_var($error, FILTER_SANITIZE_NUMBER_INT); @endphp

	                {{ $error }} <br>

	              @endforeach

	            </div>

	        @endif
			<div class="header-section text-center">
				<h3 class="mb-md-5 mb-4">Login Here
			</div>
			<form action="{{ url('/login') }}" method="post" class="">
				{{ csrf_field() }}
				<div class="main-input">
					<input type="email" name="email" placeholder="Enter your email" class="contact-input" required="" />
					<input type="password" name="password" placeholder="Enter your password" class="contact-input" required="" />
				
				</div>
				<div class="text-right" style="text-align: center !important;">
					<button class="btn-primary btn theme-button" type="submit">login</button>
				</div>
			</form>
		</div>
	</div>
</section>







@include('layouts.homelayouts.footer')
