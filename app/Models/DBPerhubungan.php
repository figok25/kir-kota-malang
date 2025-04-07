<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBPerhubungan extends Model
{
    protected $connection = 'mysql_perhubungan';
    protected $table = 'datarfid';
    protected $primaryKey = 'idx'; 
    public $timestamps = false; 
}
