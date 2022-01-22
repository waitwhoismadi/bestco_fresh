<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\User_education;
use Illuminate\Http\Request;

class UserEducationController extends Controller
{

    public function store(EducationRequest $request){

        $education = new User_education();
        $education->user_id = auth()->user()->id;
        $education->institute = $request->institute;
        $education->from = $request->from;
        $education->to = $request->to;
        $education->degree = $request->degree;
        $education->detail = $request->detail;
        $education->save();

        $response['status'] = 'success';
        $response['response'] = 'Added Education Successfully!';

        return response()->json($response);
    }

    public function update(User_education $education, EducationRequest $request)
    {
        if($education->user_id == auth()->user()->id):
            $education->institute = $request->institute;
        $education->from = $request->from;
        $education->to = $request->to;
        $education->degree = $request->degree;
        $education->detail = $request->detail;
        $education->save();

        $response['status'] = 'success';
        $response['response'] = 'Education Updated Successfully!';

            else:

                $response['status'] = 'error';
                $response['response'] = 'Unauthorized User!';

            endif;

        return response()->json($response);
    }

    public function delete($education_id)
    {
        $education = User_education::find(decrypt($education_id));
        $education->delete();

        return response()->json(decrypt($education_id,'200'));
    }
}
