<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public static function save_company($request){
        $company = new company();

        $company->company_name = $request->input('company_name');
        $company->slug = Str::slug($request->input('company_name'));
        $company->email = $request->input('company_email');
        $company->industry = $request->input('industry_type');
        $company->contact_no = $request->input('phone');

        $company->save();

        return $company;
    }

    public function companies_list(){

        $companies = Company::byauth()->orderBy('id','DESC')->get();

        return view('company.companies-list',compact('companies'));
    }

    public function company_profile(Company $company){
        $user = $company->user;
        return view('user.user_profile',compact('user'));
    }

}
