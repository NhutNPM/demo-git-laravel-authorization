<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // 
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // $groupId = DB::table('groups')->insertGetId([
        //     'name' => 'Administrator',
        //     'user_id' => 0,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
        // if ($groupId > 0) {
        //     $userId = DB::table('users')->insertGetId([
        //         'name' => 'Minh Nhựt',
        //         'email' => 'chillies.nhut.16800@gmail.com',
        //         'password' => Hash::make('admin!@#'),
        //         'group_id' => $groupId,
        //         'user_id' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]);

        //     if ($userId > 0) {
        //         for ($i = 1; $i <= 5; $i++) {
        //             DB::table('posts')->insert([
        //                 'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        //                 'content' => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.",
        //                 'user_id' => $userId,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s'),
        //             ]);
        //         }
        //     }
        // }

        // 
        DB::table('modules')->insert([
            [
                'name' => 'user',
                'title' => 'Quản lý người dùng',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'group',
                'title' => 'Quản lý nhóm',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'post',
                'title' => 'Quản lý bài viết',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
