<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    
    protected $fillable = [
        'runner_id', 'year', 'full_name', 'first_name', 'last_name', 'age', 'gender', '5k_time', '10k_time', 'half_time', 'full_time', 'location', 'city', 'state', 'country'
    ];

    /**
     * Get the next available runner id value
     * @param   \Illuminate\Database\Eloquent\Builder
     * @return  \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNextRunnerID($query)
    {
        return (int)$query->max('runner_id') + 1;
    }

    /**
     * Check whether a result exists for a previous year
     * @param   \App\Result     the result to check
     * @return  \App\Result
     */
    public static function isExistingRunner($result)
    {
        // An existing runner has the same name and gender, and a younger age based on the difference between the two years
        $query = \DB::select('
            SELECT * 
            FROM results 
            WHERE 1=1 
            AND full_name = "'.$result->full_name.'" 
            AND gender = "'.$result->gender.'" 
            AND year < "'.$result->year.'"
            AND age = "'.$result->age.'" - ("'.$result->year.'" - year) 
            ORDER BY year DESC 
            LIMIT 1
        ');

        return is_array($query) && count($query) ? $query[0] : false;
    }

    /**
     * Check whether a result already exists
     * @param   \App\Result
     * @return  bool
     */
    public static function isDuplicateRunner($result)
    {
        $query = Result::where('year', $result->year)->where('full_name', $result->full_name)->where('age', $result->age)->where('gender', $result->gender)->where('location', $result->location)->first();

        return $query != null;
    }

    /**
     * Get all Perfect Dopeys
     * @return  array
     */
    public static function getPerfects()
    {
        $query = \DB::select('
            SELECT *
            FROM results
            GROUP BY runner_id 
            HAVING COUNT(*) = 3
        ');

        return $query;
    }

    /**
     * Get the total number of participants by year
     * @return  array
     */
    public static function getTotalsByYear()
    {
        $query = \DB::select("
            SELECT year, COUNT(*) 
            FROM results 
            GROUP BY year
        ");

        return $query;
    }

    /**
     * Get data for Perfect Dopeys for a specific year
     * @param   int     the year in question
     */
    public static function getPerfectsByYear($year = 2014)
    {
        // TODO: reference config value for firstYear here

        if ($year < 2014) {
            return false;
        }

        $sql = "
            SELECT r1.* 
            FROM results r1 
            JOIN (SELECT MAX(id) AS id, runner_id, COUNT(runner_id) 
            FROM results 
            WHERE year <= $year 
            GROUP BY runner_id 
            HAVING COUNT(runner_id) = ($year - 2013)) r2 ON r2.id = r1.id
        ";

        $query = \DB::select($sql);

        return $query;
    }
}
