<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Snap
 *
 * @mixin \Eloquent
 */
class Snap extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content', // In markdown format
        'slug',
        'favorite',
        'timesViewed',
        'timesEdited',
        // 'private',
        // 'tags',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'favorite' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    //-------------------------------------------------------------------------------
    // Relationships
    //-------------------------------------------------------------------------------
    public function user() {
        return $this->belongsTo(User::class)->select(['id', 'username']); // Only return a subset of the user fields (you do not want to send the API token to *all* users)
    }
}
