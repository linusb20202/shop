<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class User extends Model
{
    use Sortable;
    //
    public $sortable = ['id', 'first_name','slug', 'email_address','contact','created_at'];
    
    protected $fillable = [
        'user_name', 'first_name', 'last_name', 'email_address', 'contact', 'address', 'city', 'state', 'zipcode', 'country_id', 'preferred_language', 'paypal_email', 'payoneer_email',
        'bank_name', 'bank_country', 'bank_state', 'bank_city', 'account_name', 'account_number', 'iban_number', 'swift_code'
    ];
    
    public function Country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function messagesReceived(){
        return $this->hasMany(Message::class, 'receiver_id', 'id');
    }
    public function messagesSent(){
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }
    public function unreadMessages(){
        return $this->hasMany(Message::class, 'sender_id', 'id')->where('status', 0);
    }
    public function Messages(){
        return $this->hasMany('App\Models\Message');
    }
    public function lastMessage()
    {
        return $this->hasOne(Message::class, 'sender_id', 'id')->latest();
    }
}
