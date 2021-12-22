@extends('layouts.adminlayout.admin_design')

@section('content')

<div class="page-header">

    <div class="container-fluid">

        <div class="pull-right">

            <button type="submit" form="form-category" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>

            <a href="{{ url('view-petitions') }}" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>

            <h1>Petitions</h1>

            <ul class="breadcrumb">

                <li><a href="#">Home</a></li>

                <li><a href="#">Petitions</a></li>

            </ul>

        </div>

    </div>

    <div class="container-fluid">

        <div class="panel panel-default">

            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Petitions</h3>

            </div>

            <div class="panel-body">

      
                <form action="{{url('edit-petitions/'.$id)}}" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">

                    {{ csrf_field() }}

                    @if($errors->any())

                        <div class="alert alert-danger">

                          @foreach($errors->all() as $error)

                            @php $j = (int) filter_var($error, FILTER_SANITIZE_NUMBER_INT); @endphp

                            {{ $error }} <br>

                          @endforeach

                        </div>

                    @endif

                  

                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-general">

                      
                            <div class="tab-content">

                                <div class="tab-pane active">

                                    <input type="hidden" name="parent_id" value="0">


                                    <div class="form-group required">

                                        <label class="col-sm-2 control-label" for="input-name2">Petition Name</label>

                                        <div class="col-sm-10">

                                            <input type="text" name="title" placeholder="Petition Name" id="input-name2" class="form-control" value="{{ $petitions[0]->title }}" required="required" />

                                        </div>

                                    </div>

                                 <div class="form-group">

                                        <label class="col-sm-2 control-label" for="input-description2">Description</label>

                                        <div class="col-sm-10">

                                            <textarea name="description" placeholder="Description" id="input-description2" data-toggle="summernote" data-lang="" class="form-control" >{{$petitions[0]->description}}</textarea>

                                        </div>

                                    </div>

                                </div>
                                <div class="form-group">

                                <label class="col-sm-2 control-label">Image (400 * 350)</label>

                                <div class="col-sm-10">               

                                     <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" value="" />

                                </div>

                                 @if(isset($petitions[0]->image) && ($petitions[0]->image) !="")

                                    <div class="col-sm-2">                         

                                    </div>

                                    <div class="col-sm-10"> 

                                        <br>

                                        <img width="100px" height="100px" src="{{ asset('assets/images/categories/'.$petitions[0]->image) }}">

                                    </div>

                                @endif

                            </div>


                            <div class="form-group">

                                <label class="col-sm-2 control-label" for="input-status">Status</label>

                                <div class="col-sm-10">

                                    <select name="status" id="input-status" class="form-control">

                                        <option value="1" @if($petitions[0]->status == '1') selected="selected" @endif >Enabled</option>

                                        <option value="0" @if($petitions[0]->status == '0') selected="selected" @endif >Disabled</option>

                                    </select>

                                </div>

                            </div>

                                {{-- @endforeach --}}

                            </div>

                        </div>

                      

                          

                </div>

            </form>

        </div>

    </div>

</div>

  <script type="text/javascript"><!--

$('input[name=\'path\']').autocomplete({

    'source': function(request, response) {

        $.ajax({

            url: 'index.php?route=catalog/category/autocomplete&user_token=ljub6bgRFxl3Rt6KNTrmrjfVNRN5qqk0&filter_name=' +  encodeURIComponent(request),

            dataType: 'json',

            success: function(json) {

                json.unshift({

                    category_id: 0,

                    name: ' --- None --- '

                });

                response($.map(json, function(item) {

                    return {

                        label: item['name'],

                        value: item['category_id']

                    }

                }));

            }

        });

    },

    'select': function(item) {

        $('input[name=\'path\']').val(item['label']);

        $('input[name=\'parent_id\']').val(item['value']);

    }

});

//--></script>

  <script type="text/javascript"><!--

$('input[name=\'filter\']').autocomplete({

    'source': function(request, response) {

        $.ajax({

            url: 'index.php?route=catalog/filter/autocomplete&user_token=ljub6bgRFxl3Rt6KNTrmrjfVNRN5qqk0&filter_name=' +  encodeURIComponent(request),

            dataType: 'json',

            success: function(json) {

                response($.map(json, function(item) {

                    return {

                        label: item['name'],

                        value: item['filter_id']

                    }

                }));

            }

        });

    },

    'select': function(item) {

        $('input[name=\'filter\']').val('');

        $('#category-filter' + item['value']).remove();

        $('#category-filter').append('<div id="category-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_filter[]" value="' + item['value'] + '" /></div>');

    }

});

$('#category-filter').delegate('.fa-minus-circle', 'click', function() {

    $(this).parent().remove();

});

//--></script>

<script type="text/javascript">

    $('#language a:first').tab('show');

</script>

@endsection