<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//type module
        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.index";
        $Permissions->description="View types list";
        $Permissions->module="type";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.create";
        $Permissions->description="View type create page";
        $Permissions->module="type";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.store";
        $Permissions->description="Save type data";
        $Permissions->module="type";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.edit";
        $Permissions->description="View update page";
        $Permissions->module="type";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.update";
        $Permissions->description="Update type data";
        $Permissions->module="type";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.show";
        $Permissions->description="Show type details";
        $Permissions->module="type";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.updateStatus";
        $Permissions->description="Change active status";
        $Permissions->module="type";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="types.destroy";
        $Permissions->description="Delete type data";
        $Permissions->module="type";
        $Permissions->Save();

    	//port module
        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.index";
        $Permissions->description="View ports list";
        $Permissions->module="port";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.create";
        $Permissions->description="View port create page";
        $Permissions->module="port";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.store";
        $Permissions->description="Save port data";
        $Permissions->module="port";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.edit";
        $Permissions->description="View edit page";
        $Permissions->module="port";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.update";
        $Permissions->description="Update port data";
        $Permissions->module="port";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.show";
        $Permissions->description="Show port details";
        $Permissions->module="port";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.updateStatus";
        $Permissions->description="Change active tatus";
        $Permissions->module="port";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="ports.destroy";
        $Permissions->description="Delete port data";
        $Permissions->module="port";
        $Permissions->Save();

        //device module
        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.index";
        $Permissions->description="View devices list";
        $Permissions->module="device";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.create";
        $Permissions->description="View device create page";
        $Permissions->module="device";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.store";
        $Permissions->description="Save device data";
        $Permissions->module="device";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.edit";
        $Permissions->description="View edit page";
        $Permissions->module="device";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.update";
        $Permissions->description="Update device data";
        $Permissions->module="device";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.show";
        $Permissions->description="Show device details";
        $Permissions->module="device";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.updateStatus";
        $Permissions->description="Change active tatus";
        $Permissions->module="device";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="devices.destroy";
        $Permissions->description="Delete device data";
        $Permissions->module="device";
        $Permissions->Save();

        //user module
        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.index";
        $Permissions->description="View users list";
        $Permissions->module="user";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.create";
        $Permissions->description="View user create page";
        $Permissions->module="user";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.store";
        $Permissions->description="Save user data";
        $Permissions->module="user";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.edit";
        $Permissions->description="View edit page";
        $Permissions->module="user";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.update";
        $Permissions->description="Update user data";
        $Permissions->module="user";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.viewDetails";
        $Permissions->description="View user details";
        $Permissions->module="user";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.updateStatus";
        $Permissions->description="Change active tatus";
        $Permissions->module="user";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="users.destroy";
        $Permissions->description="Delete user data";
        $Permissions->module="user";
        $Permissions->Save();

        //role module
        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.index";
        $Permissions->description="View role page";
        $Permissions->module="role";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.getDataForDataTable";
        $Permissions->description="View role datatable";
        $Permissions->module="role";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.create";
        $Permissions->description="View role create page";
        $Permissions->module="role";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.store";
        $Permissions->description="Save role data";
        $Permissions->module="role";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.edit";
        $Permissions->description="View edit page";
        $Permissions->module="role";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.update";
        $Permissions->description="Update role";
        $Permissions->module="role";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.show";
        $Permissions->description="Show role details";
        $Permissions->module="role";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="roles.destroy";
        $Permissions->description="Delete role";
        $Permissions->module="role";
        $Permissions->Save();

         //permission module
        $Permissions = new \App\Models\Permission();
        $Permissions->name="permissions.index";
        $Permissions->description="View permission page";
        $Permissions->module="permission";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="permissions.create";
        $Permissions->description="View permission create page";
        $Permissions->module="permission";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="permissions.store";
        $Permissions->description="Save permission data";
        $Permissions->module="permission";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="permissions.edit";
        $Permissions->description="View edit page";
        $Permissions->module="permission";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="permissions.update";
        $Permissions->description="Update permission";
        $Permissions->module="permission";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="permissions.show";
        $Permissions->description="Show permission details";
        $Permissions->module="permission";
        $Permissions->Save();

        $Permissions = new \App\Models\Permission();
        $Permissions->name="permissions.destroy";
        $Permissions->description="Delete permission";
        $Permissions->module="permission";
        $Permissions->Save();
    }
}
