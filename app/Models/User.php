<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\ConfirmEmail as ConfirmEmailNotification;
use App\Models\Role;
use App\Models\Post;
use App\Models\Comment;
use Mpociot\Firebase\SyncsWithFirebase;
use Storage;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class User extends CartalystUser {

    use Notifiable;

//use SyncsWithFirebase;

    protected $fillable = [
        'email',
        'code', /* i added this */
        'password',
        'last_name',
        'first_name',
        'permissions',
        'service_id',
        'company_id',
    ];
    protected $loginNames = ['code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles() {
        
        return $this->belongsToMany(Role::class,'role_user');
    }


    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function service() {
        return $this->belongsTo(Service::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function resQuars() {
        
        return $this->belongsToMany(ResQuar::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the email verification notification.
     *
     * @param  string  $confirmation_code
     * @return void
     */
    public function sendConfirmEmailNotification($confirmation_code) {
        $this->notify(new ConfirmEmailNotification($confirmation_code));
    }

    /**
     * Get user statut
     *
     * @return string
     */
    public function getStatut() {
        return $this->role->slug;
    }

    
    /**
     * Get user files directory
     *
     * @return string|null
     */
    public function getFilesDirectory() {
        if ($this->role->slug == 'redac') {
            $folderPath = 'user' . $this->id;
            if (!in_array($folderPath, Storage::disk('files')->directories())) {
                Storage::disk('files')->makeDirectory($folderPath);
            }
            return $folderPath;
        }
        return null;
    }
    


    public function violations()
    {
        return $this->hasMany('App\Violation');
    }
    


    public function solutions()
    {
         return $this->hasMany('App\Solution');
    }

    

    
}
