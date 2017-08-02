<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    protected $table = 'settings';
    protected $fillable = ['tmdb_key', 'tmdb_language', 'site_name', 'site_description', 'contact_email', 'offline', 'footer_text'];

}

