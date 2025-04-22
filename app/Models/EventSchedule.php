<?php 
namespace App\Models;

use App\Models\BaseModel as Model;
use App\Traits\ValidationTrait;

class EventSchedule extends Model
{
    
    public function __construct() {
        
        parent::__construct();
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_schedules';

    protected $fillable = array('events_id', 'title', 'time','priority');

    protected $dates = ['created_at','updated_at'];


    public function event() {
        return $this->belongsTo('App\Models\Event', 'events_id');
    }



}
