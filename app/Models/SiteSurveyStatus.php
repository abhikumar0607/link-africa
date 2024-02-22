<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSurveyStatus extends Model
{
    use HasFactory;

    protected $table = 'planning_site_survey_records';

    protected $fillable = [ 
        'circuit_id','service_id','site_survey_status', 'survey_date_received_from', 'date_site_survey', 'survey_date_on_hold','survey_date_received_from_site_a','date_site_survey_a','survey_date_on_hold_site_a'];
}
