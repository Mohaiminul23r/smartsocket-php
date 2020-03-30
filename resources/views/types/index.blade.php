@extends('layouts.app', ['activePage' => 'types.index', 'titlePage' => __('Types')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title">Add/Edit Types</h6>
          </div>
          <div class="card-body">
             @include('types.form')
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title mt-0">List of all Types</h6>
          </div>
          <div class="card-body">
            <div class="container border">
                <div class="table-responsive">
                    <table id="typeDatatable" class="table table-sm mt-3 mb-3 table-striped" style="width:100%;">
                    </table>
                </div> 
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
    $(document).ready(function () {
        typeDatatable = $('#typeDatatable').DataTable({
            dom: '<"row"<"col-12 col-sm-6"l><"col-12 col-sm-6"f><"col-12 col-sm-12"t><"col-12 col-sm-6"i><"col-12 col-sm-6"p>>',
            lengthMenu: [
                [10, 20, 50, -1], [10, 20, 50, "All"]
            ],
            buttons: [],
            ajax: {
                url: 'types',
                dataSrc: function (json) {
                    return json.data;
                },
                data: function (dataParam) {
                    return dataParam;
                }
            },
            columns: [{
                    'title': '#SL',
                    'data': 'id',
                    'width': '10%',
                    'align': 'center',
                    'className': 'font-weight-bold',
                    'render': function (data, type, row, ind) {
                        var pageInfo = typeDatatable.page.info();
                        return (ind.row + 1) + pageInfo.start;
                    }
                },
                { title: 'Name', data: "name", name: 'name','width': '20%'},             
                { title: 'Description', data: "description", name: 'description','width': '40%'},
                { title: 'Created By', data: "created_by", name: 'created_by','width': '40%'},
               
               {
                'title' : 'Status',
                'width':'10%',
                'render' : function(data, type, row, ind){
                    $status = '<label class="switch">'+
                            '<input onchange="utlt.updateStatus(this,\'types/updateStatus/'+row.id+'\',\'status\')" data-id="'+row.id+'" type="checkbox" '+((row.status == 1)?'checked':'')+'>'+
                            '<span class="slider round"></span></label>';
                    return $status;
                }
              },
                {
                    'title': 'Action',
                    'data': 'id',
                    'class': 'text-right',
                    'width': '10%',
                    'render': function (data, type, row, ind) {
                        dropdown_item = '<div class="dropdown">' +
                                '<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                    '<i class="fas fa-ellipsis-v"></i>' +
                                '</a>'+
                                '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">'+
                                    '<button class="btn btn-link text-darker p-0 m-1" data-id="' + data +'"><i class="fas fa-edit text-success m-2"></i> Edit</button><br>'+
                                    '<button class="btn btn-link text-darker delete_btn p-0 m-1" data-id="' + data +'"><i class="fas fa-trash-alt m-2 text-danger"></i> Delete</button>'+
                                '</div>'+
                            '</div>';
                        return dropdown_item;
                    }
                }
            ],
            columnDefs: [{
                searchable: false,
                orderable: false,
               // targets: [0, 2]
            }],
            responsive: true,
            autoWidth: false,
            serverSide: true,
            processing: true,
        });

        $(document).on('click', '.delete_btn', function () {
            let url = 'types/' + ($(this).attr('data-id'));
            utlt.Delete(url, '#typeDatatable');
        });

         $(document).on('click','#saveBtn', function(){
        
        utlt.asyncFalseRequest('Post','types', '#typeForm', null, null, null, function () {
            setTimeout(function() {
                window.location.replace(utlt.siteUrl('types'));
            }, 1000);
        });
    });

        
    });
</script>
@endpush