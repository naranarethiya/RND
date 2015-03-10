<?php

 /**
 * This function will be used to spit out the variable dump.
 * It takes two parameters, one is the array / variable
 * and the second is flag for exit.
 * @param  array  $var  [array or variable]
 * @param  boolean $exit [should continue or exit]
 * @return none
 */
function dsm($var, $exit = false)
{
    echo '<pre>';
    if(is_array($var) || is_object($var)) {
        print_r($var);    
    }
    else {
        echo $var;
    }
    echo '</pre>';
    $debug=debug_backtrace();
    echo "<br/> file :".$debug[0]['file'].", line :".$debug[0]['line'];
    if ($exit == true) {
        exit;
    }
}

/*
* This function will used to get keys of array in string by comma separated by default
* @param array $array [must array]
* @param string $glue [string separator]
**/
function keysImplode($array,$glue=',') {
    $keys=implode($glue,array_keys($array));
    return $keys;
}

/*
    date: to add in date
    Add : how many 
    $type : what to add , min(I),hours(H),day(D),month(M),year(Y), that is 
*/
function addDate($date,$add,$type) {
    $newDate = new DateTime($date);
    $newDate->add(new dateInterval('P'.$add.$type));
    $date=$newDate->format('Y-m-d');
    return $date;
}


/*
    date: to add in date
    Add : how many 
    $type : what to add , min(I),hours(H),day(D),month(M),year(Y), that is 
*/
function subDate($date,$add,$type) {
    $newDate = new DateTime($date);
    $newDate->sub(new dateInterval('P'.$add.$type));
    $date=$newDate->format('Y-m-d');
    return $date;
}

if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/ keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error('array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            if(is_object($row)) {
                $row=(array)$row;
            }
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }
}

/**
* Convert a string to the file/URL safe "slug" form
*
* @param string $string the string to clean
* @param bool $is_filename TRUE will allow additional filename characters
* @return string
*/
function sanitize($string = '', $is_filename = FALSE) {
    // Replace all weird characters with dashes
    $string = preg_replace('/[^\w\-'. ($is_filename ? '~_\.' : ''). ']+/u', '-', $string);

    // Only allow one dash separator at a time (and make string lowercase)
    return mb_strtolower(preg_replace('/--+/u', '-', $string), 'UTF-8');
}

/**
* This function will take a time stamp and calculate time ago.
*
* @param $time_ago
* @return string
*/
function timeAgo($time_ago) {
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    $result = "";
    // Seconds
    if($seconds <= 60)
    {
        $result = "$seconds seconds ago";
    }
    //Minutes
    else if($minutes <=60)
    {
        if($minutes==1)
            $result = "one minute ago";
        else
            $result = "$minutes minutes ago";
    }
    //Hours
    else if($hours <=24)
    {
        if($hours==1)
            $result = "an hour ago";
        else
            $result = "$hours hours ago";
    }
    //Days
    else if($days <= 7)
    {
        if($days==1)
            $result = "yesterday";
        else
            $result = "$days days ago";
    }
    //Weeks
    else if($weeks <= 4.3)
    {
        if($weeks==1)
            $result = "a week ago";
        else
            $result = "$weeks weeks ago";
    }
    //Months
    else if($months <=12)
    {
        if($months==1)
            $result = "a month ago";
        else
            $result = "$months months ago";
    }
    //Years
    else
    {
        if($years==1)
            $result = "one year ago";
        else
            $result = "$years years ago";
    }
    return $result;
}


 /**
 * This is a generic function to generate a drop down from an array.
 * @param unknown $name
 * @param unknown $array
 * @param string $selected
 * @return string
 */
function getDropdownFromArray($name, $array, $selected = null)
{
    $output = "<select name=\"{$name}\" class=\"form-control\">";
    
    $output .= "<option value=\"\">SELECT</option>";
    
    foreach ($array as $key => $value) {
        if ($selected != null && $selected == $key) {
            $output .= "<option value=\"{$key}\" selected>{$value}</option>";
        } else {
            $output .= "<option value=\"{$key}\">{$value}</option>";
        }
    }
    
    $output .= "</select>";
    
    return $output;
}
/*
* Return format of date specified
*
*/
function formatDate($dateString, $format) {
    $time = strtotime($dateString);
    return date($format, $time);
}

/*
* Convert Amount to word
*
**/
function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}
/*
*   Convert html special chars to string
**/
function convertStringToHTML($string)
    {
        $specialChars = array(
            ">" => "&gt;",
            "<" => "&lt;",
        );
        foreach ($specialChars as $char => $code) {
            $string = str_replace($char, $code, $string);
        }
        return $string;
    }


function parent_child_array($array,$parent_col) {
  $return = array();
  foreach($array as $key=>$row) {
     if (!isset($return[$row[$parent_col]])) {
        $return[$row[$parent_col]] =$row;
        $return[$row[$parent_col]]['child'] =array();
     }
     else {
        $return[$row[$parent_col]]['child'][] =$row;
     }
  }
  return $return;
}

function replaces($string,$array) {
    foreach($array as $key=>$val) {
        $string=str_replace('|*'.$key.'*|',$val,$string);
    }
    return $string;
}

/*
* Create combobox from array
*/
function generate_combobox($name,$array,$key,$value,$selected=false,$other=false) {
  if(empty($array)) {
    $output = "<select name=\"{$name}\" ".$other.">";
    $output .= "<option value=\"\">SELECT</option>";    
    $output .= "</select>";
  }
  else{  
    $output = "<select name=\"{$name}\" ".$other.">";
    $output .= "<option value=\"\">SELECT</option>";
    $keys=array_column($array,$key);
    $vals=array_column($array,$value);
    $new_array=array_combine($keys,$vals);

    foreach ($new_array as $key => $value) {
      if(is_array($selected)) {
        if (in_array($key,$selected)) {
          $output .= "<option value=\"{$key}\" selected>{$value}</option>";
        } else {
            $output .= "<option value=\"{$key}\">{$value}</option>";
        }
      }
      else {
        if ($selected != false && $selected == $key) {
          $output .= "<option value=\"{$key}\" selected>{$value}</option>";
        } else {
            $output .= "<option value=\"{$key}\">{$value}</option>";
        }
      }
    }

    $output .= "</select>";
  }
  return $output;
}

?>