 <div class="container border">
 	<h6 class="font-weight-bold mt-4 mb-3" id="title">Add Type Details</h6>
 	<form id="typeForm" autocomplete="off" enctype="multipart/form-data">
 	<div class="row">
    	<div class="col-md-3">
		 	<div class="form-group">
		    	<label for="type_name" class="font-weight-bold">Type Name</label>
		    	<input type="email" class="form-control p-2" id="type_name"placeholder="Enter type name">
		    </div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
			    <label for="description" class="font-weight-bold">Description</label>
			    <textarea class="form-control p-2" id="description" rows="2" placeholder="Type description"></textarea>
			</div>
		</div>
		<div class="col-md-3">
			<button type="button" id="saveBtn" class="btn btn-success btn-sm mt-3 border">Save</button>
			<button type="button" id="resetBtn" class="btn btn-outline-primary btn-sm mt-3">Reset</button>
		</div>
	</div>
	</form>
 </div>