 <div class="container border">
 	<h5 class="font-weight-bold mt-4 mb-3" id="title">Add Type Details</h5>
 	<form id="typeForm" autocomplete="off" enctype="multipart/form-data">
 	<div class="row">
    	<div class="col-md-4">
    		<input type="hidden" name="type_id" id="type_id">
		 	<div class="form-group">
		    	<label for="type_name" class="font-weight-bold">Type Name</label>
		    	<input type="text" class="form-control p-2" name="name" id="type_name"placeholder="Enter type name">
		    	<span class="d-none help-block"></span>
		    </div>
		</div>
		<div class="col-md-8">
			<div class="form-group">
			    <label for="description" class="font-weight-bold">Description</label>
			    <textarea class="form-control p-2" id="description" name="description" rows="2" placeholder="Type description"></textarea>
			    <span class="d-none help-block"></span>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-12" style="text-align:center;">
			<button type="button" id="saveBtn" class="btn btn-success btn-sm mt-2 mb-2 border">Save</button>
			<button type="button" id="editBtn" class="d-none btn btn-info btn-sm mt-2 mb-2 border">Update</button>
			<button type="button" id="resetBtn" class="btn btn-outline-primary btn-sm mt-2 mb-2">Reset</button>
			<button type="button" id="backBtn" onclick="index()" class="d-none btn btn-outline-info btn-sm mt-2 mb-2"><i class="fas fa-reply text-danger pr-2"></i>Back</button>
		</div>
	</div>
	</form>
 </div>
