<?php
// app/Models/Etudiant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Etudiant extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'adresse',
        'date_naissance',
    ];
       protected $dates = ['deleted_at'];
}
