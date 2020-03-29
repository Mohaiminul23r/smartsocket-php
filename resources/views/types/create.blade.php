@extends('layouts.app', ['activePage' => 'types.index', 'titlePage' => __('Types')])
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ _('Add Circular Details') }}</h5>
            </div>
            <div class="card-body col-md-12">
                <form id="typeForm" autocomplete="off" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name"><strong>Type Name</strong><span class="ml-1 text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Type Name">
                                <span class="d-none help-block"></span>
                            </div>   
                        </div>
                       <div class="col-md-6">
                        <div class="form-group">
                            <label for="description"><strong>Decriptions</strong><span class="ml-1 text-danger">*</span></label><br>
                            <input type="text" name="description">
                            <div class="colnm-12" id="description"></div>

                        </div>
                    </div> 
                       
                 </div>
                 
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="add_type_btn" class="btn btn-fill btn-success btn-sm">Add Type</button>
                        <button type="Reset" id="reset_btn" class="btn btn-fill btn-warning btn-sm">Reset</button>
                        <button type="button" id="cancel_btn" class="btn btn-fill btn-default btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@push('js')
<script type="text/javascript">
  
   $(document).ready(function(){

     $(document).on('click','#add_type_btn', function(){
     
        utlt.asyncFalseRequest('Post','types', '#typeForm', null, null, null, function () {
            setTimeout(function() {
                window.location.replace(utlt.siteUrl('types'));
            }, 1000);
        });
    }); 

     $(document).on('click','#cancel_btn', function(){
        window.location.replace(utlt.siteUrl('types'));
    }); 

     
});
</script>
@endpush
