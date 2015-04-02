<?php  namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TriggerAddress extends Model {

    protected $fillable = ['address', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get a user by trigger email address.
     *
     * @param $address
     * @return mixed
     */
    public static function getUser($address)
    {
        try {
            $trigger = self::where('address', '=', $address)->firstOrFail();
            return $trigger->user;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

}