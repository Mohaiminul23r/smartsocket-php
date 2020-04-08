<div class="modal fade" id="assignRoleModal" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-plain">
                <div class="modal-header">
                  <div class="card-header card-header-primary text-center p-2 w-100">
                  	<div class="row">
                  		<div class="col-md-10">
                  			<h5 class="pl-5 mb-0">Assign Roles for the User</h5>
                  		</div>
                  		<div class="col-md-2">
                  			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                  		</div>
                  	</div>	
                  </div>
                </div>
                @php
                	$roles = \App\Models\Role::all();
                @endphp
                <div class="modal-body">
                    <form id="assign_form">
                        <div class="card-body">
                        	<input type="hidden" name="user_id" id="user_id">
                        	<div class="form-group ml-3">
					        <div class="row" id="role_list">
					          @foreach ($roles as $role)
					          <div class="col-md-4 form-check">  
					            <label class="form-check-label text-dark" style="font-size:15px;"><input type="checkbox" name="role[]" class="form-check-input" value="{{ $role->id }}">{{$role->name}}
					            <span class="form-check-sign">
					              <span class="check"></span>
					          </span></label>
					          </div>
					          @endforeach
					        </div>
					      </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer p-2">
		        <button type="button" id="assign_role_btn" class="btn btn-outline-primary btn-sm">Save Changes</button>
		        <button type="button" id="modal_close_btn" class="btn btn-outline btn-sm" data-dismiss="modal">Close</button>
		      </div>
            </div>
        </div>
    </div>
</div>