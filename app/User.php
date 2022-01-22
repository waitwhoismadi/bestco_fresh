<?php

namespace App;

use ApplyJobs;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug', 'role_type', 'company_id', 'email','category', 'password', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function company(){
        return $this->hasOne(company::class,'id','company_id');
    }

    public function category_detail(){
        return $this->hasOne(user_categories::class,'id','category');
    }

    public function social_link(){
        return $this->hasOne(User_social_links::class,'user_id','id');
    }

    public function feeds(){
        return $this->hasMany(Feed::class,'user_id','id');
    }

    public function applying_jobs(){
        return $this->hasMany(apply_job::class,'user_id','id');
    }

    public function working_projects(){
        return $this->hasMany(Project_bid::class,'user_id','id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'review_to','id');
    }

    public function notification_setting(){
        return $this->hasOne(User_notification_setting::class,'user_id','id');
    }

    public function scopeSuggestusers($query){

        if(auth()->user()):
            $following_list = follow_list::where('follow_by',auth()->user()->id)->pluck('follow_to');

            $query->whereNotIn('id',$following_list);
            $query->OrwhereIn('id',follow_list::whereIn('follow_by',$following_list)->where('follow_to','!=',auth()->user()->id)->pluck('follow_to'));

        endif;


    }

    public function scopeUsers($query){

        $query->where('role_type','user');
        if(auth()->user()):
            $query->where('id','!=',auth()->user()->id);
        endif;

        if(auth()->user() && auth()->user()->role_type == 'user'):
            $query->where('category',auth()->user()->category);
        endif;


    }

    public function overview(){
        return $this->hasOne(User_overview::class,'user_id','id');
    }

    public function experience(){
        return $this->hasMany(User_experience::class,'user_id','id');
    }

    public function education(){
        return $this->hasMany(User_education::class,'user_id','id');
    }

    public function skill(){
        return $this->hasMany(User_skills::class);
    }
}
