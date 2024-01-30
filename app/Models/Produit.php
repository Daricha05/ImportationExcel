<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'libelle', 'annee', 'valeur_caf', 'poids_net'];

    // protected $attributes = [
    //     'Libelle' => 'Aucune',
    // ];
}