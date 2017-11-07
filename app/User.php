<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * App\User
 *
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract {
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',  //FIXME The username cannot be changed once created
        'email',     //FIXME This can't be good security-wise, Fix that?
        'password',  //FIXME This can't be good security-wise, Fix that?
        'api_token', //FIXME This can't be good security-wise, Fix that?
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        // 'password', //FIXME Uncomment : this allows for now to get the hashed password from the database, and compare it with `Hash:check()`
        'remember_token',
        // 'api_token', //FIXME Uncomment : this allows for now to get the api_token from the database, to be able to send it to the authed user
    ];

    //-------------------------------------------------------------------------------
    //Validation rules
    //-------------------------------------------------------------------------------
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username'  => 'required|max:255',
        'email'     => 'required|email|max:254|unique:users',
        'password'  => 'required|confirmed|min:12',
        'api_token' => 'required|min:60|max:60',
    ];

    //-------------------------------------------------------------------------------
    // Relationships
    //-------------------------------------------------------------------------------
    public function snaps() {
        return $this->hasMany(Snap::class);
    }

    //TODO Add a mutator so that any 'null' user_id gets transformed to the 'Anonymous' account?
}
