<?php

namespace App\Http\Controllers;

use App\User;
use App\user_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = user_categories::all();

        return response($categories,'200');
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
            'category_name'=>['required','string',Rule::unique('user_categories')]
        ]);

        if($validation->fails()){
            $response['status'] = 'validation_errors';
            $response['errors']= $validation->errors();

        }
        else{
        $category = new user_categories();
        $category->category_name = $request->input('category_name');
        $category->slug = Str::slug($request->input('category_name'));
        if($category->save()){
            $response['status'] = 'success';
            $response['data'] = $category;
        }
    }
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user_categories  $user_categories
     * @return \Illuminate\Http\Response
     */
    public function show(user_categories $user_categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user_categories  $user_categories
     * @return \Illuminate\Http\Response
     */
    public function edit(user_categories $user_categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user_categories  $user_categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user_categories $category)
    {
        $validation = Validator::make($request->all(),[
            'category_name'=>['required','string',Rule::unique('user_categories')->ignore($category->id)]
        ]);

        if($validation->fails()){
            $response['status'] = 'validation_errors';
            $response['errors']= $validation->errors();

        }
        else{
        $category->category_name = $request->input('category_name');
        $category->slug = Str::slug($request->input('category_name'));
        if($category->save()){
            $response['status'] = 'success';
            $response['data'] = $category;
        }
    }
        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user_categories  $user_categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_categories $category)
    {
        if(User::where('category',$category->id)->exists()):
            $response['status'] = 'error';
            $response['msg'] = 'Category Delete Failed, because  this Category are Used from users';
            return response($response);
        else:
            $category->delete();
            $response['status'] = 'success';
            $response['msg'] = 'Delete Category Successfully';
            return response($response);
        endif;
    }
}
