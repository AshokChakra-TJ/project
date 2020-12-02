<?php

    // Retrieving Json Data
    $jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
    $data = json_decode($jsonData, true);

    // Counting the number of days in the Json File
    foreach($data as $key => $value){
        $days_count = count($value)-1;
        $days_count_prev = $days_count - 1;
    }

    $total_confirmed = 0;
    $total_recovered = 0;
    $total_deaths = 0;

    // Total Cases Calculation
    foreach($data as $key => $value){
        $total_confirmed = $total_confirmed + $value[$days_count]['confirmed'];
        $total_recovered = $total_recovered + $value[$days_count]['recovered'];
        $total_deaths = $total_deaths + $value[$days_count]['deaths'];
    }
    //Total Cases in India
    foreach($data as $key => $value)
    {
        if($key=='India')
        {
            $total_confirmed_india=$value[$days_count]['confirmed'];
            $total_recovered_india=$value[$days_count]['recovered'];
            $total_deaths_india=$value[$days_count]['deaths'];
        }
    }

?>