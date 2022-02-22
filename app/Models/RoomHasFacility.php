<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomHasFacility extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

   /**
    * Get the room that owns the RoomHasFacility
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function room(): BelongsTo
   {
       return $this->belongsTo(Room::class);
   }

   /**
    * Get the facility that owns the RoomHasFacility
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function facility(): BelongsTo
   {
       return $this->belongsTo(Facility::class, 'facility_code', 'code');
   }
}
