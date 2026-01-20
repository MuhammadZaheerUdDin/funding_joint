<?php

namespace App\Model\Identification;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $table = 'documents';

    const ADDRESS = 'address';
    const IDENTITY = 'identity';
    protected $fillable = [
        'type_proof',
        'file_name'
        ];


    public function user() {

        return $this->belongsTo('App\Model\Users\User');
    }
}
