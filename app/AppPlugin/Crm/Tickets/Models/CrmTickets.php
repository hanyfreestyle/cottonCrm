<?php

namespace App\AppPlugin\Crm\Tickets\Models;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\Http\Livewire\Site\Cart\CustomerAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class CrmTickets extends Model {

    protected $table = "crm_ticket";
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function scopeDef(Builder $query): Builder {
        return $query->where('id','!=',0);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scopeDefOpen(Builder $query): Builder {
        return $query->where('state',1)
            ->where('user_id','!=',null)
            ->with('customer')
            ->with('device_name')
            ->with('user')
            ->with('user');
    }

    public function scopeDefNew(Builder $query): Builder {
        return $query->where('state',1)->where('follow_state',1);
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(CrmCustomers::class,'customer_id','id')->with('address');
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function device(): BelongsTo {
        return $this->belongsTo(ConfigData::class,'device_id','id')->with('translation')->select('name as hhhhhhhh');
    }

    public function device_name(): BelongsTo {
        return $this->belongsTo(ConfigDataTranslation::class,'device_id','data_id')
            ->where('locale' , 'ar');
    }







}
