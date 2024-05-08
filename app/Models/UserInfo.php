<?php

namespace App\Models;

use App\Core\Traits\SpatieLogsActivity;
use App\Traits\SaveToTitleCase;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Storage;

class UserInfo extends Model
{
    use SpatieLogsActivity;
    use SaveToTitleCase;

    protected $fillable = ['user_id', 'surname', 'first_names', 'email_address'];

    /**
     * Prepare proper error handling for url attribute
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        // if file avatar exist in storage folder
        $avatar = public_path(Storage::url($this->avatar));
        if (is_file($avatar) && file_exists($avatar)) {
            // get avatar url from storage
            return Storage::url($this->avatar);
        }

        // check if the avatar is an external url, eg. image from google
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        // no avatar, return blank avatar
        return asset(theme()->getMediaUrlPath().'avatars/blank.png');
    }

    /**
     * User info relation to user model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentType()
    {
        return $this->belongsTo(StudentType::class, 'citizenship_status');
    }

    /**
     * Unserialize values by default
     *
     * @param $value
     *
     * @return mixed|null
     */
    public function getCommunicationAttribute($value)
    {
        // test to un-serialize value and return as array
        $data = @unserialize($value);
        if ($data !== false) {
            return $data;
        } else {
            return null;
        }
    }

    /**
     * Get a fullname combination of first_name and last_name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_names} {$this->surname}";
    }

    public function genderType()
    {
        return $this->belongsTo(GenderType::class, 'gender_id');
    }

    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id');
    }

    public function nextOfKin()
    {
        return $this->hasMany(UserInfoNextOfKin::class);
    }

    public function schoolSubjects()
    {
        return $this->hasMany(UserInfoSchoolSubjects::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function previousQualification()
    {
        return $this->hasMany(UserInfoPreviousQualification::class);
    }

    public function healthQuestionnaire()
    {
        return $this->hasOne(HealthQuestionnaire::class);
    }

    public function employment()
    {
        return $this->hasOne(UserInfoEmployment::class);
    }

    public function educationSystem(){
        return $this->belongsTo(EducationSystem::class, 'education_system_id');
    }

    public function gender(){
        return $this->belongsTo(GenderType::class, 'gender_id');
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function documents(){
        return $this->hasMany(StudentDocument::class);
    }

    public function registration(){
        return $this->hasMany(Registration::class);
    }

}
