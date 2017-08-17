<?php

namespace App\Models\Attraction;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Config;
use App\Models\User\User;


class AttractionReview extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'AT_attraction_reviews';

    /**
     * The default order by
     *
     * @var string
     */
    protected $default_order_by = 'id';
    
    /**
     * The default order column
     *
     * @var string
     */
    protected $default_order = 'ASC';

    /**
     * The group by column
     *
     * @var string
     */
    protected $group_by = null;

    /**
     * The joins used by the model.
     *
     * @var array
     */
    protected $joins = array(
        //
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'attraction_id', 'rating'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The rules used for the validation
     *
     * @var array
     */
    public static $rules = array(
//
    );

    /**
     * The custom messages used for the validation
     *
     * @var array
     */
    public static $messages = array(
        //
    );


    public function attraction()
    {
        return $this->hasOne(Attraction::class, 'id', 'attraction_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


}