<?php  namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model {

    protected $fillable = [
        'uid',
        'subject',
        'from',
        'sent',
        'message',
        'html_message',
        'user_id',
        'to',
        'actioned'
    ];

    protected $table = 'email_messages';

    public static function isUnique($uid)
    {
        return (! self::where('uid', '=', $uid)->count() > 0);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

} 