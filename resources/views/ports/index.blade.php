@extends('layouts.app', ['activePage' => 'ports.index', 'titlePage' => __('Manage Ports')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h5 class="card-title font-weight-bold">Add/Edit Ports</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
              
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h5 class="card-title mt-0 font-weight-bold">List of all Ports</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             	<table id="portDatatable" class="table" style="width:100%;">
             	</table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    portDatatable = $('#portDatatable').DataTable({
        dom: '<"row"<"col-12 col-sm-6"l><"col-12 col-sm-6"f><"col-12 col-sm-12"t><"col-12 col-sm-6"i><"col-12 col-sm-6"p>>',
        lengthMenu: [[10,20,50, -1], [10,20,50, "All"]],
        buttons: [],
        ajax: {
            url: 'ports',
            dataSrc: function (json) {
                return json.data;
            },
            data: function (dataParam) {
                return dataParam;
            }
        },
        columns: [
            {
                'title' : '#SL',
                'data' : 'id',
                'width' : '10%',
                'align' : 'center',
                'render' : function(data, type, row, ind){
                    var pageInfo = portDatatable.page.info();
                    return (ind.row + 1) + pageInfo.start;
                }
            },
            {title : 'Port Name', data: "name", name: 'name', 'width':'30%'},
            {title : 'Description', data: "description", name: 'description','width':'60%'},
            {
                'title' : 'Status',
                'width':'10%',
                'render' : function(data, type, row, ind){
                    $status = '<label class="switch">'+
                            '<input onchange="utlt.updateStatus(this,\'events/updateStatus/'+row.id+'\',\'status\')" data-id="'+row.id+'" type="checkbox" '+((row.status == 1)?'checked':'')+'>'+
                            '<span class="slider round"></span></label>';
                    return $status;
                }
            },
            {
                'title' : 'Action',
                'data' : 'id', 
                'class' : 'text-right',
                'width' : '10%', 
                'render' : function(data, type, row, ind){
                    dropdown_item = '<div class="dropdown">'+
                        '<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                       '<i class="fas fa-ellipsis-v"></i>'+
                       '</a>'+
                          '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">'+
                            '<a href="'+utlt.siteUrl('events/'+row.id+'/edit')+'" class="btn btn-link  text-darker"><i class="fas fa-edit text-success m-2"></i> Edit</a>'+
                            // '<a href="'+utlt.siteUrl('dailyTrades/'+row.id)+'" target="_blank" class="btn btn-link  text-darker"><i class="fas fa-eye-slash m-2"></i> View</a>'+
                            '<button class="btn btn-link  text-darker delete_btn" data-id="'+data+'"><i class="fas fa-trash-alt m-2 text-danger"></i> Delete</button>'+
                           '</div>'+
                   '</div>';
                   return dropdown_item;
                }
            }
        ],
        columnDefs: [
            {searchable: false, orderable:false, targets: [0,2]}
        ],
        responsive: true,
        autoWidth: false,
        serverSide: true,
        processing: true,
    }); 

    $(document).on('click', '.delete_btn', function(){
        let url = 'events/'+($(this).attr('data-id'));
        utlt.Delete(url,'#portDatatable');
    });
});
</script>
@endpush