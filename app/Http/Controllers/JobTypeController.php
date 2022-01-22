<?php

namespace App\Http\Controllers;

use App\Feed;
use App\job_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_types = job_type::latest()->get();

        return response($job_types,200);
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
            'type' =>' required'
        ]);

        if($validation->fails()){
            $response['status'] = 'validation_errors';
            $response['errors']= $validation->errors();

        }
        else{
            $job_type = new job_type();
            $job_type->type = $request->type;
            if($job_type->save()){
                $response['status'] = 'success';
                $response['data'] = $job_type;
            }
        }

        return response($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\job_type  $job_type
     * @return \Illuminate\Http\Response
     */
    public function show(job_type $job_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\job_type  $job_type
     * @return \Illuminate\Http\Response
     */
    public function edit(job_type $job_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\job_type  $job_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $job_type)
    {
        $job_type = job_type::find($job_type);

        $validation = Validator::make($request->all(),[
            'type' =>['required','string',Rule::unique('job_types')->ignore($job_type->id)]
        ]);

        if($validation->fails()){
            $response['status'] = 'validation_errors';
            $response['errors']= $validation->errors();

        }
        else{

            $job_type->type = $request->type;
            if($job_type->save()){
                $response['status'] = 'success';
                $response['data'] = $job_type;
            }
        }

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\job_type  $job_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($job_type)
    {
        $job_type = job_type::find($job_type);

        if(Feed::jobs()->where('job_type',$job_type->id)->exists()):
            $response['status'] = 'error';
            $response['msg'] = 'Job type Delete Failed, because  this job type are Used from users';
            return response($response);
        else:
            $job_type->delete();
            $response['status'] = 'success';
            $response['msg'] = 'Delete job type Successfully';
            return response($response);
        endif;
    }
}
