 <div class="container border">
 	<h5 class="font-weight-bold mt-4 mb-3" id="title">Add Device Details</h5>
 	<form id="deviceForm" autocomplete="off" enctype="multipart/form-data">
 	<div class="row">
 		<div class="col-md-4">
    		<input type="hidden" name="device_id" id="device_id">
			<div class="form-group">
			    <label for="type" class="font-weight-bold">Device Type<span class="ml-1 text-danger">*</span></label>
			    <select class="form-control" name="type_id" id="type">
			      <option value="" disabled selected>Select Device Type</option>
			      @foreach($types as $type)
			      	<option value="{{$type->id}}">{{$type->name}}</option>
			      @endforeach
			    </select>
			    <span class="d-none help-block"></span>
			</div>
		</div>
 		<div class="col-md-4">
		 	<div class="form-group">
		    	<label for="espId" class="font-weight-bold">Device ID<span class="ml-1 text-danger">*</span></label>
		    	<input type="text" class="form-control p-2" name="espId" id="espId"placeholder="Enter device ID">
		    	<span class="d-none help-block"></span>
		    </div>
		</div>
    	<div class="col-md-4">
		 	<div class="form-group">
		    	<label for="device_name" class="font-weight-bold">Device Name<span class="ml-1 text-danger">*</span></label>
		    	<input type="text" class="form-control p-2" name="name" id="device_name"placeholder="Enter device name">
		    	<span class="d-none help-block"></span>
		    </div>
		</div>	
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
	            <label for="description" class="font-weight-bold"><strong>Description</label><span class="ml-1 text-danger">*</span></strong>
	            <input type="hidden" name="description">
	            <div class="col-sm-12" id="description"></div>
	            <span class="d-none help-block"></span>
        	</div>
		</div>
	</div>
	</form>
	<div class="row">
		<div class="col-md-12" style="text-align:center;">
			<button type="button" id="saveBtn" class="btn btn-success btn-sm mt-2 mb-2 border">Save</button>
			<button type="button" id="editBtn" class="d-none btn btn-info btn-sm mt-2 mb-2 border">Update</button>
			<button type="button" id="resetBtn" class="btn btn-outline-primary btn-sm mt-2 mb-2">Reset</button>
			<button type="button" id="backBtn" onclick="index()" class="d-none btn btn-outline-info btn-sm mt-2 mb-2"><i class="fas fa-reply text-danger pr-2"></i>Back</button>
		</div>
	</div>
 </div>
