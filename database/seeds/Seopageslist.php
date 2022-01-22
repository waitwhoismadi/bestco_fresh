<?php

use App\Seo_pages_list;
use Illuminate\Database\Seeder;

class Seopageslist extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            ['route_name'=>'home','page_name'=>'Home'],
            ['route_name'=>'users','page_name'=>'Users list'],
            ['route_name'=>'companies','page_name'=>'Companies list'],
            ['route_name'=>'jobs_list','page_name'=>'Jobs list'],
            ['route_name'=>'projects_list','page_name'=>'Projects list'],
            ['route_name'=>'user_profile','page_name'=>'User Profile'],
            ['route_name'=>'company_profile','page_name'=>'Company Profile'],
            ['route_name'=>'job_detail','page_name'=>'Job detail'],
            ['route_name'=>'project_detail','page_name'=>'Project detail'],
            ['route_name'=>'register','page_name'=>'Register'],
            ['route_name'=>'login','page_name'=>'Login'],
        ];
        Seo_pages_list::insert($pages);
    }
}
