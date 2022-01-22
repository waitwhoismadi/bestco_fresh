<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\company;
use App\Facades\Flash_notification;
use App\User;
use App\Http\Requests\CompanyregistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CompanyController as companyctrl;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function __construct() {
        $this->middleware('RoleAuth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = company::all();
        return view('admin.company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyregistrationRequest $request)
    {

        $company = companyctrl::save_company($request);

        $directory = 'companies/'.$company->slug;
        Storage::makeDirectory($directory);

        $user = new User();
        $user->role_type = 'company';
        $user->company_id = $company->id;
        $user->name = $company->company_name;
        $user->email = $company->email;
        $user->slug = $company->slug;
        $user->password = Hash::make($request->input('password'));
        $user->directory = $directory;

        $user->save();

        Flash_notification::set('Added New Company Successfully');

        return redirect()->route('admin.company.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        return view('admin.company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
        $request->validate([
            'company_name'=>['required','string'],
            'company_email'=>['required',Rule::unique('companies','email')->ignore($company->id, 'id'),'string','email'],
            'login_email'=>['required',Rule::unique('users','email')->ignore($company->id, 'company_id'),'string','email'],
            'industry_type'=>['required'],
            'password'=>['confirmed']
        ]);

        $company->update([
            'company_name'=>$request->input('company_name'),
            'slug'=>Str::slug($request->input('company_name')),
            'email'=>$request->input('company_email'),
            'contact_no'=>$request->input('phone'),
            'industry'=>$request->input('industry_type')
        ]);

        $company->user->update([
            'name'=>$request->input('company_name'),
            'slug'=>Str::slug($request->input('company_name')),
            'email'=>$request->input('login_email'),
            'password'=>$request->input('password')?$request->input('password'):$company->user->password,
        ]);

            Flash_notification::set('Company Update Successfully');

            return redirect()->route('admin.company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        $company->user->delete();
        $company->delete();

        Flash_notification::set('Company Deleted Successfully');
        return redirect()->route('admin.company.index');
    }

    public function industries()
    {
        return view('admin.company.industry');
    }
}
