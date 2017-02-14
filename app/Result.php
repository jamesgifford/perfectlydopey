<?php

namespace App;

use Config;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'modified_results';
    protected $guarded = [];

    /**
     * Constructor
     * @param   string  $resultType     the type of results to use (original or modified)
     * @param   array   $attributes     other model attributes
     */
    public function __construct($resultType = 'original', $attributes = array())
    {
        $resultType = in_array($resultType, ['original', 'modified']) ? $resultType : 'modified';
        $this->table = $resultType . '_results';

        parent::__construct($attributes);
    }

    /**
     * Allow static methods access to the table name
     * @return  string
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

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
        $table = Result::getTableName();

        $sql = '
            SELECT * 
            FROM '.$table.' 
            WHERE 1=1 
            AND full_name = "'.$result->full_name.'" 
            AND gender = "'.$result->gender.'" 
            AND year < "'.$result->year.'" 
            AND age = "'.$result->age.'" - ("'.$result->year.'" - year) 
            ORDER BY year DESC 
            LIMIT 1
        ';

        $query = \DB::select($sql);

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
        $table = Result::getTableName();

        $sql = "
            SELECT year, COUNT(*) 
            FROM $table 
            GROUP BY year
        ";

        $query = \DB::select($sql);

        return $query;
    }

    /**
     * Get data for Perfect Dopeys for a specific year
     * @param   int     the year in question
     */
    public static function getPerfectsByYear($year = null)
    {
        $table = Result::getTableName();

        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT r1.* 
            FROM $table r1 
            JOIN (SELECT MAX(id) AS id, runner_id, COUNT(runner_id) 
            FROM $table 
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
        $table = Result::getTableName();

        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT age, COUNT(*) AS count
            FROM $table 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM $table 
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
        $table = Result::getTableName();

        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT CASE gender WHEN 'M' THEN 'Men' ELSE 'Women' END AS gender, COUNT(*) AS count
            FROM $table 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM $table 
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
        $table = Result::getTableName();

        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT state, COUNT(*) AS count
            FROM $table 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM $table 
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
        $table = Result::getTableName();

        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $sql = "
            SELECT country, COUNT(*) AS count
            FROM $table 
            WHERE id IN (SELECT MAX(id) AS id 
                FROM $table 
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
        $table = Result::getTableName();

        if ($year == null || $year < Config::get('dopey.firstYear')) {
            $year = Config::get('dopey.lastYear');
        }

        $field = $event.'_time';

        $sql = "
            SELECT minutes, COUNT(*) AS count
            FROM (SELECT runner_id, ROUND(SUM(MINUTE($field) + (HOUR($field)*60))/3) AS minutes, COUNT(*) AS count
                FROM $table 
                WHERE runner_id IN (SELECT runner_id 
                    FROM $table 
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
