<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\User_experience;
use Illuminate\Http\Request;

class UserExperienceController extends Controller
{

    public function store(ExperienceRequest $request){

            $experience = new User_experience();

            $experience->user_id = auth()->user()->id;
            $experience->title = $request->title;
            $experience->detail = $request->detail;
            $experience->save();

            $response['status'] = 'success';
            $response['response'] = 'Added Experience Successfully!';

        return response()->json($response);
    }

            public function update(User_experience $experience, ExperienceRequest $request){

                if($experience->user_id == auth()->user()->id):
                $experience->title = $request->title;
                $experience->detail = $request->detail;
                $experience->save();

                $response['status'] = 'success';
                $response['response'] = 'Experience Updated Successfully!';

                else:

                    $response['status'] = 'error';
                    $response['response'] = 'Unauthorized User!';

                endif;

            return response()->json($response);
        }

        public function delete($experience_id){

            $experience = User_experience::find(decrypt($experience_id));

            $experience->delete();

            return response()->json(decrypt($experience_id),'200');
        }
}
