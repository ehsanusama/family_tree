<?php

// In the Connection.php model file (app/Models/Connection.php)

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = ['person_id', 'related_person_id', 'relationship_type'];

    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }
}

