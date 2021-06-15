<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = ['title', 'description', 'company', 'posted_at', 'reference_id'];
}
