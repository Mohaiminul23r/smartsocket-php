 <div class="container border">
 	<h5 class="font-weight-bold mt-4 mb-3" id="title">Edit Role Details</h5>
 	<form id="roleEditForm" autocomplete="off" enctype="multipart/form-data">
 	<div class="row">
    	<div class="col-md-4">
    		<input type="hidden" name="edit_role_id" id="edit_role_id" value="{{$role->id}}">
		 	<div class="form-group">
		    	<label for="port_name" class="font-weight-bold">Role Name</label>
		    	<input type="text" class="form-control p-2" name="name" value="{{$role->name}}" id="port_name"placeholder="Enter role name">
		    	<span class="d-none help-block"></span>
		    </div>
		</div>
		<div class="col-md-8">
			<div class="form-group">
			    <label for="description" class="font-weight-bold">Description</label>
			    <textarea class="form-control p-2" id="description" name="description" rows="2" placeholder="Role description">{{$role->description}}</textarea>
			    <span class="d-none help-block"></span>
			</div>
		</div>
	</div>
	<div class="row">
    <div class="col-md-12">
        <h5 class="font-weight-bold" style="text-align:left;">Update Permissions for the Role</h5><hr>
        <div class="form-check text-uppercase mb-2" style="font-size: 17px; text-align: center; font-weight: bold;">
		    <label class="form-check-label">
		        <input class="form-check-input group-all-check-all hidden" type="checkbox" value="">Select All
		        <span class="form-check-sign">
		            <span class="check"></span>
		        </span>
		    </label>
		</div>
        <div class="row group-all">
            @php
	            $row = [
	                '<div class="row">','','','','</div>'
	            ];
	            $countRow=0;
            @endphp
            @foreach ($permissions as $module => $value)
                {!!$row[$countRow++]!!}
                <div class="group-parent">
                    <ul style="list-style:none;">
                        <li class="text-uppercase" style="font-size: 17px;"><strong><label><input class="group-checkbox hidden mr-1" type="checkbox"><span class="text-dark text-capitalize text-primary font-weight-bold" style="font-size: 14px;">{{$module}} Module</span></label></strong></li>
                        @foreach ($value as $permission)
                        	@php
                                $chceked = "";
                                if (in_array($permission->id, $role_permission))
                                    $chceked = "checked";
                            @endphp
                            <li><label class="pr-3"><input class="sub-checkbox" type="checkbox" {{$chceked}} name="permission[]" value="{{$permission->id}}"> {{$permission->description}}</label></li>

                        @endforeach
                    </ul>
                </div>
                {!!$row[$countRow]!!}                
            @php
                if($countRow == 4)
                    $countRow = 0;
            @endphp
            @endforeach
            @php
            if($countRow != 4)
                echo $row[4];
            @endphp
        </div>
    </div>
</div>
</form>
	<div class="row">
		<div class="col-md-12" style="text-align:center;">
			<button type="button" id="editBtn" class="btn btn-info btn-sm mt-2 mb-2">Update</button>
			<button type="button" id="cancelBtn" class="btn btn-outline btn-sm mt-2 mb-2">Cancel</button>
		</div>
	</div>
 </div>
