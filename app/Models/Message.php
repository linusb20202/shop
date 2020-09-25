<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Message extends Model
{
    use Sortable;
    //
    public $sortable = ['id', 'title','created_at'];
    protected $fillable = ['sender_id','receiver_id','message','attachment','status','time'];
    
    public function Sender(){
        return $this->belongsTo('App\Models\User', 'sender_id');
    }
    public function Receiver(){
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function scopeLatestSendersMessages($query) 
    {
         return $query->orderBy('created_at', 'desc')
             ->get()
             ->unique('sender_id');
    }
}
