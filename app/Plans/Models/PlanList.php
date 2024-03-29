<?php

namespace App\Plans\Models;

use App\Plans\Traits\Listable;
use App\Plans\Traits\HasProfile;
use App\Profiles\Models\Profile;
use Illuminate\Database\Eloquent\Model;

class PlanList extends Model
{
    use HasProfile;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'q2_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label_color','owner_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ]; 

     
    /**
     * 
     * @return  Profile Lists 
     */
    public function profileLists()
    {
       return $this->belongsToMany(Profile::class, 'q2_list_profiles', 'list_id');
    } 

    /**
     * Add Profiles to List
     *
     * @return  Profiles $profiles
     */
    public function addProfile($profilesIds,$request)
    {   
        
        if ($profilesIds){
              $this->profileLists()->attach($profilesIds,[
                                    'plan_id' => $this->plan_id,
                                    'facebook_delivariables' => $request->facebook_delivariables,
                                    'instagram_delivariables' => $request->instagram_delivariables,
                                    'youtube_delivariables' => $request->youtube_delivariables,
                                    'twitter_delivariables' => $request->twitter_delivariables,
                                    'blog_delivariables' => $request->blog_delivariables
                                ]);
        }
        return  $profilesIds;
        
    } 

    /**
     * Remove Profiles from List
     * @return  Profiles $profiles
     */
    public function removeProfiles($profilesIds)
    {
        $profiles = explode(',',$profilesIds);
        if ($profiles){
              $this->profileLists()->detach($profiles, ['plan_id' => $this->plan_id]);
        }
        return  $profiles;        
    }

    /**
     * Get the all keywords owns list
     */
    public function keywords()
    {
       return $this->hasMany('App\Plans\Models\ListKeyword', 'list_id');
    }
}
