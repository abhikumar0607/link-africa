<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddSiteSurveyStatus extends Model
{
    use HasFactory;
    Protected $table = 'site_survey_status';
    Protected $fillable = ['site_survey_status'];
}
