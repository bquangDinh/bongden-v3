<?php

use Illuminate\Database\Seeder;
use App\UserPermission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $normal_permissions = array(
          "write_article",
          "edit_article",
          "view_self_article",
          "delete_self_article",
          "write_discussion",
          "view_self_discussion",
          "edit_discussion",
          "vote_discussion"
        );

        $content_executive_permissions = array(
          "view_other_article",
          "approve_other_article",
          "deny_other_article"
        );

        $user_manager_permissions = array(
          "give_permission",
          "preview_user_profile"
        );

        //run
        foreach($normal_permissions as $permission){
          $p = new UserPermission;
          $p->name = $permission;
          $p->save();
        }

        foreach($content_executive_permissions as $permission){
          $p = new UserPermission;
          $p->name = $permission;
          $p->save();
        }

        foreach($user_manager_permissions as $permission){
          $p = new UserPermission;
          $p->name = $permission;
          $p->save();
        }
    }
}
