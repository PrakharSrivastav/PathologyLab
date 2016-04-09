<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model {
    
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "test_date", "testing_lab", "case_number", "report_name", "patient_history",
        "description", "status", "addition_details"
    ];

    /**
     * Convert the test_date in carbon format
     *
     * @var array
     */
    protected $dates = ["test_date"];

    /**
     * report name to be in title format while saving
     * 
     * @param String $name
     */
    public function setReportNameAttribute($name) {
        $this->attributes['report_name'] = ucwords($name);
    }

    /**
     * report name to be in title format while reading
     * 
     * @param String $name
     */
    public function getReportNameAttributes($name) {
        return ucwords($name);
    }

    /**
     * A report will always belong to a user
     * 
     * @return App\User
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function setTestDateAttribute($testdate){
        $this->attributes['test_date'] = Carbon::createFromFormat('d-m-Y', $testdate);
    }
    
}
