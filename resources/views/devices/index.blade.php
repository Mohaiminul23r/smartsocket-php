@extends('layouts.app', ['activePage' => 'Devices', 'titlePage' => __('Manage Devices')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title">Add/Edit Device</h6>
          </div>
          <div class="card-body">
            @include('devices.form')
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title mt-0">List of all Devices</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container border">
               	<table id="deviceDatatable" class="table table-sm mt-3 mb-3 table-striped" style="width:100%;">
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
$(document).ready(function(){
	$('#type').select2();
	init_port_select2();
   ClassicEditor.create(document.querySelector('#description'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
            'blockQuote'
        ],
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                }
            ]
        }
    }).then(editor => {
        window.description = editor;
        // if(typeof details != 'undefined' && details != null)
        //     window.details.setData(oldDetails);
    }).catch(error => {
        console.log(error);
    });
    deviceDatatable = $('#deviceDatatable').DataTable({
        dom: '<"row"<"col-12 col-sm-6"l><"col-12 col-sm-6"f><"col-12 col-sm-12"t><"col-12 col-sm-6"i><"col-12 col-sm-6"p>>',
        lengthMenu: [[10,20,50, -1], [10,20,50, "All"]],
        buttons: [],
        ajax: {
            url: 'devices',
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
                'width' : '6%',
                'align' : 'center',
                'render' : function(data, type, row, ind){
                    var pageInfo = deviceDatatable.page.info();
                    return (ind.row + 1) + pageInfo.start;
                }
            },
            {title : 'Device Id', data: "espId", name: 'espId', 'width':'10%'},
            {title : 'Name', data: "deviceName", name: 'name', 'width':'15%'},
            {title : 'Type', data: "typeName", name: 'type_id', 'width':'15%'},
            {title : 'Description', data: "description", name: 'description','width':'20%'},
            {title : 'Created By', data: "userName", name: 'created_by','width':'15%'},
            {title : 'Port', 'width':'8%', 'render' : function(data, type, row, ind){
            		let port = [];
            		$.each(row.ports, function(ind, val){
            			let span = '<span class="badge badge-primary">'+val.name+'</span>';
            			port.push(span);
            		});
            		return port;
            	}
        	},
            {
                'title' : 'Status',
                'width':'15%',
                'render' : function(data, type, row, ind){
                   $status = '<div class="togglebutton">'+
                              ' <label>'+
                                 '<input type="checkbox" onchange="utlt.updateStatus(this,\'devices/updateStatus/'+row.id+'\',\'status\')" data-id="'+row.id+'" type="checkbox" '+((row.status == 1)?'checked':'')+'>'+
                                   '<span class="toggle"></span>'+
                              ' </label>'+
                             '</div>';
                    return $status;
                }
            },
            {
                'title' : 'Action',
                'data' : 'id', 
                'class' : 'text-right',
                'width' : '6%', 
                'render' : function(data, type, row, ind){
                 dropdown_item = '<div class="dropdown">' +
                            '<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                '<i class="fas fa-ellipsis-v"></i>' +
                            '</a>'+
                            '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">'+
                                '<button class="btn btn-link text-darker edit_btn p-0 m-1" data-id="' + data +'"><i class="fas fa-edit text-success m-2"></i> Edit</button><br>'+
                                '<button class="btn btn-link text-darker delete_btn p-0 m-1" data-id="' + data +'"><i class="fas fa-trash-alt m-2 text-danger"></i> Delete</button>'+
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
        let url = 'devices/'+($(this).attr('data-id'));
        utlt.Delete(url,'#deviceDatatable');
    });

    //reset form
    $(document).on('click', '#resetBtn', function(){
        reset_form();
    });

    //insert data for port
    $(document).on('click', '#saveBtn', function(){
        $(document).find('#deviceForm .has-danger').removeClass('has-danger');
        $(document).find('#deviceForm').find('.help-block').empty();
        $(document).find('input[name="description"]').val(window.description.getData());
         axios.post(''+utlt.siteUrl('devices')+'', $('#deviceForm').serialize())
         .then(response => {
            showToast("Successfully Added. ");
            reset_form();
            $('#deviceDatatable').DataTable().ajax.reload();            
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#deviceForm [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#deviceForm [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#deviceForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#deviceForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
    });

    //add preious data at edit port details
     $(document).on('click', '.edit_btn', function(){
         let device_id = $(this).attr('data-id');
         $('#device_id').val(device_id);
         change_button();
         axios.get(''+utlt.siteUrl('devices/'+device_id+'/edit')+'')
         .then(response => {
         	//console.log(response.data.ports.length);
            $("#type").val(null).trigger('change');
            $("#port").val(null).trigger('change');
            $('#device_name').val('');
            $('#espId').val('');
            window.description.setData('');
            $("#type").val(response.data.type_id).trigger('change');
            if(response.data.ports.length != 0){
         		let ports = [];
	            $.each(response.data.ports, function(ind, val){
	            	ports.push(val.id);
	            });	
            	$('#port').val(ports).change();
            }else if(response.data.ports.length == 0){
            	init_port_select2();
            }
            $('#device_name').val(response.data.name);
            $('#espId').val(response.data.espId);
            window.description.setData(response.data.description);
         })
    });

     //update when button clicked
     $('#editBtn').click(function(){
         let edit_device_id = $('#device_id').val();
         $(document).find('input[name="description"]').val('');
         $(document).find('input[name="description"]').val(window.description.getData());
         axios.put(''+utlt.siteUrl('devices/'+edit_device_id)+'', $('#deviceForm').serialize())
         .then(response => {
            showToast("Successfully Updated !!", 'warning');
            $(document).find('#deviceForm').trigger("reset");
            $('#deviceDatatable').DataTable().ajax.reload();
            index();
         })
         .catch(error => {
            $.each(error.response.data.payload.errors, function(inputName, errors){
                $("#deviceForm [name="+inputName+"]").parent().removeClass('has-danger').addClass('has-danger');
                if(typeof errors == "object"){
                    $("#deviceForm [name^="+inputName+"]").parent().find('.help-block').empty();
                    $.each(errors, function(indE, valE){
                      console.log(valE);
                        $("#deviceForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').append(valE+"<br>");
                        $('.help-block').css("color", "red");
                    });
                }else{
                    $("#deviceForm [name^="+inputName+"]").parent().find('.help-block').removeClass('d-none').html(valE);
                }
            });
         });
     });
});

function change_button(){
   $('#saveBtn').addClass('d-none');
   $('#editBtn').removeClass('d-none');
   $('#backBtn').removeClass('d-none');
   $('#title').text('Edit Device Details');
}

function index(){
   //window.location.replace(utlt.siteUrl('devices'));
   $('#saveBtn').removeClass('d-none');
   $('#editBtn').addClass('d-none');
   $('#backBtn').addClass('d-none');
   $('#title').text('Add Device Details');
   reset_form();
}

function reset_form(){
   $(document).find('#deviceForm').trigger("reset");
   $(document).find('#deviceForm .has-danger').removeClass('has-danger');
   $(document).find('#deviceForm').find('.help-block').empty();
   $(document).find('input[name="description"]').val('');
   window.description.setData('');
   $("#type").val(null).trigger('change');
   $("#port").val(null).trigger('change');
}

function show_port_modal(){
	$('#portModal').modal('show');
}

function init_port_select2(){
	$('#port').select2();
}
</script>
@endpush