<?php

use Illuminate\Support\Facades\Response;
class GlobalHelper {
    /**
     * This function will set the message in session so that when the page renders,
     * we can display a message on top of the page.
     * @param $message
     * @param string $flag
     */
    public static function setMessage($message, $flag = 'error')
    {
        $tempMessage = '';
        if (Session::get('error')) {
            $tempMessage = Session::get('error');
        }
    
        if ($tempMessage == "") {
            $tempMessage = '<li>'.$message.'</li>';
        }
        else {
            $tempMessage = $tempMessage.$message;
        }
    
        Session::flash($flag, $tempMessage);
    }

    /*
    *   return last Executed query by laravel
    **/
    public static function last_query() {
        $queries = DB::getQueryLog();
        return $last_query = end($queries);
    }

    /*
    *   Print last Executed query by laravel
    **/
    public function print_last_query() {
        $this->dsm($this->last_query());
    }

    /*
    * Convert date to specified format
    * Default format is define in config/app.php
    */
    public static function formatDate($date,$format=false) {
        if(!$format) {
            $format=Config::get('app.date_format');
        }
        $new = date_create($date);
        return date_format($new,$format);
    }

    /*
    *   Return CSV file
    *   @param - $data object of db query
    *   @param - $options set first row, header and collumn order
    **/
    function convertToCSV($data, $options)
    {
        // setting the csv header
        if (is_array($options) && isset($options['headers']) && is_array($options['headers'])) {
            $headers = $options['headers'];
        } 
        else {
            $filename=date('d-M').".csv";
            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            );
        }

        $output = '';

        // setting the first row of the csv if provided in options array
        if (isset($options['firstRow']) && is_array($options['firstRow'])) {
            $output .= implode(',', $options['firstRow']);
            $output .= "\n"; // new line after the first line
        }

        // setting the columns for the csv. if columns provided, then fetching the or else object keys
        if (isset($options['columns']) && is_array($options['columns'])) {
            $columns = $options['columns'];
        }
        else {
            $objectKeys = get_object_vars($data[0]);
            $columns = array_keys($objectKeys);
        }

        // populating the main output string
        foreach ($data as $row) {
            foreach ($columns as $column) {
                $output .= str_replace(',', ';', $row->$column);
                $output .= ',';
            }
            $output .= "\n";
        }

        // calling the Response class make function inside my class to send the response.
        // if our class is not a controller, this is required.
        return Response::make($output, 200, $headers);
    }
}