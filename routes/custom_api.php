<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api','middleware'=>'auth'], function () {

//-----------profile_pic

Route::post('update-profile-pic', 'ProfileController@update_profilepic');
Route::post('update-cover-img', 'ProfileController@update_coverimg');

//------------job_cadidate---------------

Route::get('job_candidate_detail/{candidate}','JobsController@candidate_detail');
Route::get('job_candidates_list/{job}','JobsController@candidates_list');
Route::delete('job_candidate_delete/{candidate}','JobsController@candidate_delete');

//------------feed---------------------
Route::delete('delete_feed/{feed}','FeedController@delete_feed');
Route::put('update_job/{job}', 'JobsController@update_job')->name('update_job');
Route::put('update_project/{project}', 'ProjectController@update_project')->name('update_project');
Route::post('like_unlikefeed', 'FeedController@like_unlike');
Route::post('save_unsavefeed','FeedController@save_unsave');
Route::put('change-feed-status/{feed}','FeedController@change_feedstatus');


//------------project-------------------
Route::get('project_bidders/{project}','ProjectController@project_bidders');
Route::put('reopen_bid/{bid}','ProjectController@reopen_bid');
Route::put('accept-bid/{bid}/{project}','ProjectController@accept_bid');

//-----------portfolio------------------
Route::post('upload_portfolio', 'PortfolioController@upload');


//-----------review------------------
Route::post('save_review_reply','ReviewController@save_reply');


//-----------info-------------------
Route::post('update-about','UserOverviewController@update_about')->name('update_about');
Route::post('add-experience', 'UserExperienceController@store')->name('add_experience');
Route::Put('update-experience/{experience}', 'UserExperienceController@update')->name('update_experience');
Route::Delete('delete-experience/{experience_id}', 'UserExperienceController@delete');
Route::post('add-education', 'UserEducationController@store')->name('add_education');
Route::Put('update-education/{education}', 'UserEducationController@update')->name('update_education');
Route::Delete('delete-education/{education_id}', 'UserEducationController@delete');
Route::post('update-location', 'UserOverviewController@update_location');
Route::post('add-skill', 'UserOverviewController@store_skills');
Route::Delete('delete-skill/{skill}', 'UserOverviewController@delete_skill');
Route::Post('update-establish_since','UserOverviewController@update_establish');
Route::Post('update-category','UserOverviewController@update_category')->name('update_category');

//-----------chat------------------

Route::get('get-chat-users', 'ChatController@get_chat_users');
Route::get('get-chat-messages/{receiver_id}', 'ChatController@get_chat_messages');
Route::post('send_msg', 'ChatController@send_message');
Route::get('get-last-msg/{chat_id}/{type}', 'ChatController@get_last_messages');
Route::get('get-useronline-status/{user_id}','ChatController@get_useronline_status');
Route::get('get-custom-user/{receiver}','ChatController@get_custom_user');

});
?>
