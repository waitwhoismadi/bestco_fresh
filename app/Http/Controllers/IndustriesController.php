<?php

namespace App\Http\Controllers;

use App\company;
use App\industry_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class IndustriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industries = industry_type::all();

        return response($industries,'200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'industry_name'=>['required','string',Rule::unique('industry_types')]
        ]);

        if($validation->fails()){
            $response['status'] = 'validation_errors';
            $response['errors']= $validation->errors();

        }
        else{
        $industry = new industry_type();
        $industry->industry_name = $request->input('industry_name');
        $industry->slug = Str::slug($request->input('industry_name'));
        if($industry->save()){
            $response['status'] = 'success';
            $response['data'] = $industry;
        }
    }
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, industry_type $industry)
    {
        $validation = Validator::make($request->all(),[
            'industry_name'=>['required','string',Rule::unique('industry_types')->ignore($industry->id)]
        ]);

        if($validation->fails()){
            $response['status'] = 'validation_errors';
            $response['errors']= $validation->errors();

        }
        else{
        $industry->industry_name = $request->input('industry_name');
        $industry->slug = Str::slug($request->input('industry_name'));
        if($industry->save()){
            $response['status'] = 'success';
            $response['data'] = $industry;
        }
    }
        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(industry_type $industry)
    {
        if(company::where('industry',$industry->id)->exists()):
            $response['status'] = 'error';
            $response['msg'] = 'industry Delete Failed, because  this industry are Used from users';
            return response($response);
        else:
            $industry->delete();
            $response['status'] = 'success';
            $response['msg'] = 'Delete industry Successfully';
            return response($response);
        endif;
    }
}
