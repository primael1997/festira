<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //

    public function category_document(){
        return $this->belongsTo(CategoryDocument::class);
    }
}
