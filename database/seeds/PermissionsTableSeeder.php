<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'event_create',
            ],
            [
                'id'    => '18',
                'title' => 'event_edit',
            ],
            [
                'id'    => '19',
                'title' => 'event_show',
            ],
            [
                'id'    => '20',
                'title' => 'event_delete',
            ],
            [
                'id'    => '21',
                'title' => 'event_access',
            ],
            [
                'id'=> '22',
                'title' => 'appointment_access',
                
            ],
            [
                'id'=> '23',
                'title' => 'appointment_create',
                
            ],
            [
                'id'=> '24',
                'title' => 'appointment_edit',
                
            ],
            [
                'id'=> '25',
                'title' => 'appointment_show',
                
            ],
            [
                'id'=> '26',
                'title' => 'appointment_delete',
                
            ],
            [
                'id'=> '27',
                'title' => 'university_access',
                
            ],
            [
                'id'=> '28',
                'title' => 'university_show',
                
            ],
            [
                'id'=> '29',
                'title' => 'university_delete',
                
            ],
            [
                'id'=> '30',
                'title' => 'university_edit',
                
            ],
            [
                'id'=> '31',
                'title' => 'university_create',
                
            ],
            [
                'id'=> '32',
                'title' => 'career_access',
                
            ],
            [
                'id'=> '33',
                'title' => 'career_show',
                
            ],
            [
                'id'=> '34',
                'title' => 'career_create',
                
            ],
            [
                'id'=> '35',
                'title' => 'career_edit',
                
            ],
            [
                'id'=> '36',
                'title' => 'career_delete',
                
            ],
            [
                'id'=> '37',
                'title' => 'course_access',
                
            ],
            [
                'id'=> '38',
                'title' => 'course_show',
                
            ],
            [
                'id'=> '39',
                'title' => 'course_create',
                
            ],
            [
                'id'=> '40',
                'title' => 'course_edit',
                
            ],
            [
                'id'=> '41',
                'title' => 'course_delete',
                
            ],
        ];

        Permission::insert($permissions);
    }
}
