<?php

namespace App;

use Config;
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
    public static function getPerfectsByYear($year = null)
    {
        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT r1.* 
            FROM results r1 
            JOIN (SELECT MAX(id) AS id, runner_id, COUNT(runner_id) 
            FROM results 
            WHERE year <= $year 
            GROUP BY runner_id 
            HAVING COUNT(runner_id) = ($year - (".Config::get('dopey.firstYear')." - 1))) r2 ON r2.id = r1.id
        ";

        $query = \DB::select($sql);

        return $query;
    }

    /**
     * Get the count of Perfect Dopeys grouped by age
     */
    public static function countPerfectsByAge($year = null)
    {
        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT age, COUNT(*) AS count
            FROM results 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM results 
                WHERE year <= $year 
                GROUP BY runner_id 
                HAVING COUNT(runner_id) = ($year - (".Config::get('dopey.firstYear')." - 1))) 
            GROUP BY age 
            ORDER BY age ASC
        ";

        $query = \DB::select($sql);

        return $query;
    }

    /**
     * Get the count of Perfect Dopeys grouped by gender
     */
    public static function countPerfectsByGender($year = null)
    {
        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT CASE gender WHEN 'M' THEN 'Men' ELSE 'Women' END AS gender, COUNT(*) AS count
            FROM results 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM results 
                WHERE year <= $year 
                GROUP BY runner_id 
                HAVING COUNT(runner_id) = ($year - (".Config::get('dopey.firstYear')." - 1))) 
            GROUP BY gender 
            ORDER BY gender ASC
        ";

        $query = \DB::select($sql);

        return $query;
    }

    /**
     * Get the count of Perfect Dopeys grouped by gender
     */
    public static function countPerfectsByState($year = null)
    {
        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT state, COUNT(*) AS count
            FROM results 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM results 
                WHERE year <= $year 
                GROUP BY runner_id 
                HAVING COUNT(runner_id) = ($year - (".Config::get('dopey.firstYear')." - 1))) 
            AND country = 'US' 
            AND state NOT IN ('AP') 
            GROUP BY state 
            ORDER BY state ASC
        ";

        $query = \DB::select($sql);

        return $query;
    }

    /**
     * Get the count of Perfect Dopeys grouped by gender
     */
    public static function countPerfectsByCountry($year = null)
    {
        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT country, COUNT(*) AS count
            FROM results 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM results 
                WHERE year <= $year 
                GROUP BY runner_id 
                HAVING COUNT(runner_id) = ($year - (".Config::get('dopey.firstYear')." - 1))) 
            GROUP BY country 
            ORDER BY country ASC
        ";

        $query = \DB::select($sql);

        return $query;
    }

    /**
     * Get the count of Perfect Dopeys grouped by race length
     */
    public static function countPerfectsByEvent($event = '5k', $year = null)
    {
        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $field = $event.'_time';

        $sql = "
            SELECT minutes, COUNT(*) AS count
            FROM (SELECT runner_id, ROUND(SUM(MINUTE($field) + (HOUR($field)*60))/3) AS minutes, COUNT(*) AS count
                FROM results 
                WHERE runner_id IN (SELECT runner_id 
                    FROM results 
                    WHERE year <= $year 
                    GROUP BY runner_id 
                    HAVING COUNT(runner_id) = ($year - (".Config::get('dopey.firstYear')." - 1))) 
                GROUP BY runner_id) AS thing
            GROUP BY minutes
            ORDER BY minutes ASC
        ";

        $query = \DB::select($sql);

        return $query;
    }
}
