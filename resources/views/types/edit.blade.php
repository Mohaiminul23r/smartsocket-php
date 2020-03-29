@extends('layouts.app', ['page' => __('Circular Manager')])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Edit Circular Details') }}</h5>
                </div>
                <div class="card-body col-md-12">
                    <form id="circularEditForm" autocomplete="off" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="e_id" id="e_id" value="{{$circular->id}}">
                                <div class="form-group">
                                    <label for="title"><strong>Circular Title</strong><span class="ml-1 text-danger">*</span></label>
	                                <input type="text" name="title" class="form-control" placeholder="Circular title" value="{{$circular->title}}">
	                                <span class="d-none help-block"></span>
                                </div>   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="language"><strong>Language</strong><span class="ml-1 text-danger">*</span></label>
                                    <input type="text" name="language" class="form-control" placeholder="Enter Language" value="{{$circular->language}}">
                                    <span class="d-none help-block"></span>
                                </div>  
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="news_details"><strong> Date</strong><span class="ml-1 text-danger">*</span></label>
                                      <input type="text" class="form-control datepicker" name="date" id="date" placeholder="yyyy-mm-dd" autocomplete="off" value="{{$circular->date}}">
                                    <span class="d-none help-block"></span>
                                </div>  
                            </div>
                            
                        </div>
                        <div class="row">                            
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="content"><strong>Content</strong><span class="ml-1 text-danger">*</span></label><br>
                                    <input type="hidden" name="content">
                                    <div class="colnm-12" id="content" ></div>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="custom-file">
                                    <label for="news_title"><strong>Attachment</strong></label><br>
                                    <input type="file" class="mt-2" id="attachment" name="attachment">
                                    <a target="_blank" href="{{url($circular->attachment)}}">View Previous Attachment</a>
                                    <span class="d-none help-block"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mt-4">
                                <div class="form-group">
                                    <label for="home_page" class="col-form-label"><strong>Circular Status</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="status"
                                        @if($circular->status == 1) 
                                        checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="d-none help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="edit_circular_btn" class="btn btn-fill btn-success btn-sm">Update</button>
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
var oldContent = '<?php echo isset($circular->content)?$circular->content:'' ?>' ;
$(document).ready(function(){
   

   $(function(){
        $('.datepicker').datetimepicker({
            timepicker: false,
            format: 'Y-m-d'
        });
    });

   
   $(document).on('click','#edit_circular_btn', function(){
        let id = $('#e_id').val();
        $(document).find('input[name="content"]').val(window.content.getData());
        utlt.asyncFalseRequest('Put','circulars/'+id+'', '#circularEditForm', null, null, null, function () {
            setTimeout(function() {
                window.location.replace(utlt.siteUrl('circulars'));
            }, 1000);
        });
    }); 
    $(document).on('click','#cancel_btn', function(){
		window.location.replace(utlt.siteUrl('circulars'));
    }); 

    ClassicEditor.create(document.querySelector('#content'), {
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
            window.content = editor;
            if(typeof content != 'undefined' && content != null)
                window.content.setData(oldContent);
        }).catch(error => {
            console.log(error);
        });
});
</script>
@endpush
