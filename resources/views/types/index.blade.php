@extends('layouts.app', ['activePage' => 'types.index', 'titlePage' => __('Types')])
@section('content')
  <div class="content">
    <div class="container-fluid">
 <div class="card">
           <div class="card-header">
                <h5 class="title">{{ _('Type List') }}</h5>
            </div>
            <div class="card-body col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" href="{{route('types.create')}}" class="text-white pull-right mb-3 mt-0 mr-1 btn btn-fill btn-sm btn-info"><i class="fas fa-plus"></i>{{ _(' Add') }}</a>
                    </div>
                </div>
                <table id="typeDatatable" class="table" style="width:100%;">
                </table>
            </div>
        </div>
    </div>
  	</div>
  
@endsection
@push('js')
<!-- <script type="text/javascript">
    $(document).ready(function(){

    });
</script> -->
<script type="text/javascript">
    $(document).ready(function () {
        typeDatatable = $('#typeDatatable').DataTable({
            dom: '<"row"<"col-12 col-sm-6"l><"col-12 col-sm-6"f><"col-12 col-sm-12"t><"col-12 col-sm-6"i><"col-12 col-sm-6"p>>',
            lengthMenu: [
                [10, 20, 50, 100, 500, -1],
                [10, 20, 50, 100, 500, "All"]
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
                    'width': '8%',
                    'align': 'center',
                    'render': function (data, type, row, ind) {
                        var pageInfo = typeDatatable.page.info();
                        return (ind.row + 1) + pageInfo.start;
                    }
                },
                {
                    title: 'Name',
                    data: "name",
                    name: 'name'
                },
               
                 {
                    title: 'Decription',
                    data: "decription",
                    name: 'decription'
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
                                '</a>' +
                                '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">' +
                                    '<a class="btn btn-link text-darker" href="' + utlt.siteUrl('types/' + data+'/edit') +'"><i class="fas fa-edit text-success m-2"></i> Edit</a>' +
                                    '<button class="btn btn-link  text-darker delete_btn" data-id="' + data +'"><i class="fas fa-trash-alt m-2 text-danger"></i> Delete</button>' +
                                '</div>' +
                            '</div>';
                        return dropdown_item;
                    }
                }
            ],
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: [0, 2]
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
    });
</script>
@endpush