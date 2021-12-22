@extends('layouts.adminlayout.admin_design')

@section('content')

<div id="content">
<div class="page-header">
  <div class="container-fluid">
     <h1>Contacts</h1>
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Contacts</a></li>
    </ul>
  </div>
</div>
@if(Session::has('flash_message_error'))
  <div class="alert alert-error alert-block" style="margin: 18px;">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{!! session('flash_message_error') !!}</strong>
  </div>
@endif   

@if(Session::has('flash_message_success'))
  <div class="alert alert-success alert-block" style="margin: 18px;">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{!! session('flash_message_success') !!}</strong>
  </div>
@endif
<div class="container-fluid">
  <div class="row">

    <div class="col-md-12  col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-list"></i> Order List</h3>
        </div>
        <div class="panel-body">
          <form method="post" action="" enctype="multipart/form-data" id="form-order">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <th>#</th>               
                  <th>Name</th>                
                  <th>Email</th>                 
                  <th>Phone</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $i=1;
                @endphp
                @foreach($contacts as $t)
                <tr class="gradeX">
                  <td>{{$i}}</td>
                  <td>{{$t->name}}</td>
                  <td>{{$t->email}}</td>
                  <td>{{$t->phone}}</td>
                  <td>{{$t->message}}</td>
                  <td>
                  <a href="{{url('delete-contact',$t->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Remove?')">Delete</a></td>
                </tr>
                @php $i++; @endphp
                @endforeach
                </tbody>
              </table>
          </div>
          </form>
          {{-- <p>{{ $orders->links() }}</p>   --}}         
        </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">

$('#button-filter').on('click', function() {
  url = '';

  var filter_order_id = $('input[name=\'filter_order_id\']').val();

  if (filter_order_id) {
    url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
  }

  var filter_customer = $('input[name=\'filter_customer\']').val();

  if (filter_customer) {
    url += '&filter_customer=' + encodeURIComponent(filter_customer);
  }

  var filter_order_status_id = $('select[name=\'filter_order_status_id\']').val();

  if (filter_order_status_id !== '') {
    url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
  }

  var filter_total = $('input[name=\'filter_total\']').val();

  if (filter_total) {
    url += '&filter_total=' + encodeURIComponent(filter_total);
  }

  var filter_date_added = $('input[name=\'filter_date_added\']').val();

  if (filter_date_added) {
    url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
  }

  var filter_date_modified = $('input[name=\'filter_date_modified\']').val();

  if (filter_date_modified) {
    url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
  }

  location = 'index.php?route=sale/order&user_token=uZEK0vcKjYnlcFr7GMND4y731ZMOUbwC}' + url;
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter_customer\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=customer/customer/autocomplete&user_token=uZEK0vcKjYnlcFr7GMND4y731ZMOUbwC&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['customer_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter_customer\']').val(item['label']);
  }
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name^=\'selected\']').on('change', function() {
  $('#button-shipping, #button-invoice').prop('disabled', true);

  var selected = $('input[name^=\'selected\']:checked');

  if (selected.length) {
    $('#button-invoice').prop('disabled', false);
  }

  for (i = 0; i < selected.length; i++) {
    if ($(selected[i]).parent().find('input[name^=\'shipping_code\']').val()) {
      $('#button-shipping').prop('disabled', false);

      break;
    }
  }
});

$('#button-shipping, #button-invoice').prop('disabled', true);

$('input[name^=\'selected\']:first').trigger('change');

// IE and Edge fix!
$('#button-shipping, #button-invoice').on('click', function(e) {
  $('#form-order').attr('action', this.getAttribute('formAction'));
});

$('#form-order li:last-child a').on('click', function(e) {
  e.preventDefault();
  
  var element = this;
  
  if (confirm('Are you sure?')) {
    $.ajax({
      url: 'http://localhost/vtech/opencart/upload/index.php?route=api/order/delete&api_token=4f7790e10e2d93517234fea398&store_id=&order_id=' + $(element).attr('href'),
      dataType: 'json',
      beforeSend: function() {
        $(element).parent().parent().parent().find('button').button('loading');
      },
      complete: function() {
        $(element).parent().parent().parent().find('button').button('reset');
      },
      success: function(json) {
        $('.alert-dismissible').remove();
  
        if (json['error']) {
          $('#content > .container-fluid').prepend('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
  
        if (json['success']) {
          location = 'http://localhost/vtech/opencart/upload/admin/index.php?route=sale/order/delete&user_token=uZEK0vcKjYnlcFr7GMND4y731ZMOUbwC';
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
});
//--></script> 
  <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
  language: 'en-gb',
  pickTime: false
})
;

  
</script>

@endsection