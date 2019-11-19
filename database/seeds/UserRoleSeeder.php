<?php

use Illuminate\Database\Seeder;
use App\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
          "normal" => "Người dùng cơ bản",
          "content_executive" => "Người phê duyệt nội dung",
          "user_manager" => "Người quản lý người dùng"
        );

        foreach($roles as $role => $description){
          $r = new UserRole;
          $r->name = $role;
          $r->description = $description;
          $r->save();
        }
    }
}
