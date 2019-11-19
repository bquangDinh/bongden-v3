<?php

use Illuminate\Database\Seeder;
use App\URoleToUPermission;
use App\UserPermission;
use App\UserRole;

class UroleUpermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //make sure User Permission and User Role have been initialized

        $URUPs = array(
          "normal" => "write_article,edit_article,view_self_article,delete_self_article,write_discussion,view_self_discussion,edit_discussion,vote_discussion",
          "content_executive" => "view_other_article,approve_other_article,deny_other_article",
          "user_manager" => "give_permission,preview_user_profile"
        );

        foreach($URUPs as $role => $permission_array){
          $permissions = explode(",",$permission_array);
          $role = UserRole::where('name',$role)->firstOrFail();
          foreach($permissions as $permission){
            $urup = new URoleToUPermission;
            $urup->role_id = $role->id;
            $p = UserPermission::where('name',$permission)->firstOrFail();
            $urup->permission_id = $p->id;
            $urup->save();
          }
        }
    }
}
