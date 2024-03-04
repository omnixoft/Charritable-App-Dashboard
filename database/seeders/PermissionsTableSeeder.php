<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 23,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 24,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 25,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 26,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 27,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 28,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 29,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 30,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 31,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 32,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 33,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 34,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 35,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 36,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 37,
                'title' => 'task_create',
            ],
            [
                'id'    => 38,
                'title' => 'task_edit',
            ],
            [
                'id'    => 39,
                'title' => 'task_show',
            ],
            [
                'id'    => 40,
                'title' => 'task_delete',
            ],
            [
                'id'    => 41,
                'title' => 'task_access',
            ],
            [
                'id'    => 42,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 43,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 44,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 45,
                'title' => 'donationtype_create',
            ],
            [
                'id'    => 46,
                'title' => 'donationtype_edit',
            ],
            [
                'id'    => 47,
                'title' => 'donationtype_show',
            ],
            [
                'id'    => 48,
                'title' => 'donationtype_delete',
            ],
            [
                'id'    => 49,
                'title' => 'donationtype_access',
            ],
            [
                'id'    => 50,
                'title' => 'donation_create',
            ],
            [
                'id'    => 51,
                'title' => 'donation_edit',
            ],
            [
                'id'    => 52,
                'title' => 'donation_show',
            ],
            [
                'id'    => 53,
                'title' => 'donation_delete',
            ],
            [
                'id'    => 54,
                'title' => 'donation_access',
            ],
            [
                'id'    => 55,
                'title' => 'governorate_create',
            ],
            [
                'id'    => 56,
                'title' => 'governorate_edit',
            ],
            [
                'id'    => 57,
                'title' => 'governorate_show',
            ],
            [
                'id'    => 58,
                'title' => 'governorate_delete',
            ],
            [
                'id'    => 59,
                'title' => 'governorate_access',
            ],
            [
                'id'    => 60,
                'title' => 'wilayat_create',
            ],
            [
                'id'    => 61,
                'title' => 'wilayat_edit',
            ],
            [
                'id'    => 62,
                'title' => 'wilayat_show',
            ],
            [
                'id'    => 63,
                'title' => 'wilayat_delete',
            ],
            [
                'id'    => 64,
                'title' => 'wilayat_access',
            ],
            [
                'id'    => 65,
                'title' => 'social_solidarity_create',
            ],
            [
                'id'    => 66,
                'title' => 'social_solidarity_edit',
            ],
            [
                'id'    => 67,
                'title' => 'social_solidarity_show',
            ],
            [
                'id'    => 68,
                'title' => 'social_solidarity_delete',
            ],
            [
                'id'    => 69,
                'title' => 'social_solidarity_access',
            ],
            [
                'id'    => 70,
                'title' => 'banner_create',
            ],
            [
                'id'    => 71,
                'title' => 'banner_edit',
            ],
            [
                'id'    => 72,
                'title' => 'banner_show',
            ],
            [
                'id'    => 73,
                'title' => 'banner_delete',
            ],
            [
                'id'    => 74,
                'title' => 'banner_access',
            ],
            [
                'id'    => 75,
                'title' => 'customer_create',
            ],
            [
                'id'    => 76,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 77,
                'title' => 'customer_show',
            ],
            [
                'id'    => 78,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 79,
                'title' => 'customer_access',
            ],
            [
                'id'    => 80,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 81,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 82,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 83,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 84,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 85,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 86,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 87,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 88,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 89,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 90,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 91,
                'title' => 'contact_us_create',
            ],
            [
                'id'    => 92,
                'title' => 'contact_us_edit',
            ],
            [
                'id'    => 93,
                'title' => 'contact_us_show',
            ],
            [
                'id'    => 94,
                'title' => 'contact_us_delete',
            ],
            [
                'id'    => 95,
                'title' => 'contact_us_access',
            ],
            [
                'id'    => 96,
                'title' => 'feedback_create',
            ],
            [
                'id'    => 97,
                'title' => 'feedback_edit',
            ],
            [
                'id'    => 98,
                'title' => 'feedback_show',
            ],
            [
                'id'    => 99,
                'title' => 'feedback_delete',
            ],
            [
                'id'    => 100,
                'title' => 'feedback_access',
            ],
            [
                'id'    => 101,
                'title' => 'thawani_setting_edit',
            ],
            [
                'id'    => 102,
                'title' => 'thawani_setting_access',
            ],
            [
                'id'    => 103,
                'title' => 'ayaht_create',
            ],
            [
                'id'    => 104,
                'title' => 'ayaht_edit',
            ],
            [
                'id'    => 105,
                'title' => 'ayaht_show',
            ],
            [
                'id'    => 106,
                'title' => 'ayaht_delete',
            ],
            [
                'id'    => 107,
                'title' => 'ayaht_access',
            ],
            [
                'id'    => 108,
                'title' => 'profile_password_edit',
            ],
            [
                "id"=>109,
                "title"=>"app_version_setting_access",
            ],
            [
                "id"=>110,
                "title"=>"willayat_edit",
            ]
        ];

        Permission::insert($permissions);
    }
}
