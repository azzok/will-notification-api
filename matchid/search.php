<?php
if (isset($_GET['query'])) {
    $input = urlencode($_GET['query']);
    $url = "https://deces.matchid.io/deces/api/v1/search?q=$input";
    
    $options = [
        "http" => [
            "header" => "User-Agent: PHP"
        ]
    ];
    $context = stream_context_create($options);
    
    $response = file_get_contents($url, false, $context);
    
    if ($response !== false) {
        $data = json_decode($response, true);
        // print_r($data);exit;
        
        echo "<div><small>Total Record: ".$data['response']['total'].", Size: ".  $data['response']['size'].", Page: ".$data['response']['page']."</small></div>";

        if (isset($data['response']['persons']) && count($data['response']['persons']) > 0) {
            foreach ($data['response']['persons'] as $person) {
                $lastName = htmlspecialchars($person['name']['last']);
                $firstName = htmlspecialchars($person['name']['first'][0]);
                $deathDate = $person['death']['date'];
                $formattedDate = preg_replace('/(....)(..)(..)/', '$3/$2/$1', $deathDate);

                $lastNameString = $person['name']['last'];
                $firstNameString = $person['name']['first'];

                $city = @$person['birth']['location']['city'];
                $code = @$person['birth']['location']['code'];
                $codePostal = @$person['birth']['location']['codePostal'];
                $codeHistory = @$person['birth']['location']['codeHistory'];
                $departmentCode = @$person['birth']['location']['departmentCode'];
                $country = @$person['birth']['location']['country'];
                $countryCode = @$person['birth']['location']['countryCode'];
                $latitude = @$person['birth']['location']['latitude'];
                $longitude = @$person['birth']['location']['longitude'];

                $certificateId = @$person['death']['certificateId'];
                $age = @$person['death']['age'];

                $death_city = @$person['death']['location']['city'];
                $death_code = @$person['death']['location']['code'];
                $death_codePostal = @$person['death']['location']['codePostal'];
                $death_codeHistory = @$person['death']['location']['codeHistory'];
                $death_departmentCode = @$person['death']['location']['departmentCode'];
                $death_country = @$person['death']['location']['country'];
                $death_countryCode = @$person['death']['location']['countryCode'];
                $death_latitude = @$person['death']['location']['latitude'];
                $death_longitude = @$person['death']['location']['longitude'];

                $source = @$person['source'];
                $sourceLine = @$person['sourceLine'];
                $score = @$person['scores']['score'];
                $es = @$person['scores']['es'];
     

                $lastNameString = is_array($lastNameString) ? implode(', ', $lastNameString) : $lastNameString;
                $firstNameString = is_array($firstNameString) ? implode(', ', $firstNameString) : $firstNameString;

                $city = is_array($city) ? implode(', ', $city) : $city;
                $code = is_array($code) ? implode(', ', $code) : $code;
                $codePostal = is_array($codePostal) ? implode(', ', $codePostal) : $codePostal;
                $codeHistory = is_array($codeHistory) ? implode(', ', $codeHistory) : $codeHistory;
                $departmentCode = is_array($departmentCode) ? implode(', ', $departmentCode) : $departmentCode;
                $country = is_array($country) ? implode(', ', $country) : $country;
                $countryCode = is_array($countryCode) ? implode(', ', $countryCode) : $countryCode;
                $latitude = is_array($latitude) ? implode(', ', $latitude) : $latitude;
                $longitude = is_array($longitude) ? implode(', ', $longitude) : $longitude;
                $certificateId = is_array($certificateId) ? implode(', ', $certificateId) : $certificateId;
                $age = is_array($age) ? implode(', ', $age) : $age;

                $death_city = is_array($death_city) ? implode(', ', $death_city) : $death_city;
                $death_code = is_array($death_code) ? implode(', ', $death_code) : $death_code;
                $death_codePostal = is_array($death_codePostal) ? implode(', ', $death_codePostal) : $death_codePostal;
                $death_codeHistory = is_array($death_codeHistory) ? implode(', ', $death_codeHistory) : $death_codeHistory;
                $death_departmentCode = is_array($death_departmentCode) ? implode(', ', $death_departmentCode) : $death_departmentCode;
                $death_country = is_array($death_country) ? implode(', ', $death_country) : $death_country;
                $death_countryCode = is_array($death_countryCode) ? implode(', ', $death_countryCode) : $death_countryCode;
                $death_latitude = is_array($death_latitude) ? implode(', ', $death_latitude) : $death_latitude;
                $death_longitude = is_array($death_longitude) ? implode(', ', $death_longitude) : $death_longitude;

                // echo "<div><small>Name: $lastName, First name: $firstName, died: $formattedDate</small></div>";

                echo '<a href="#" class="togglefaq"><i class="icon-plus"></i>Name: '.$lastName.', First name: '.$firstName.', died: '.$formattedDate.', age: '.$age.'</a><div class="faqanswer">  <table border="1" cellspacing="0" cellpadding="8" style="margin: auto;">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>'.$person['id'].'</td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td>'.$firstNameString.'</td>
                    </tr>
                     <tr>
                        <td>Last Name</td>
                        <td>'.$lastNameString.'</td>
                    </tr>
                   <tr>
                        <td>Sex</td>
                        <td>'.$person['sex'].'</td>
                    </tr>
                    <tr>
                        <td>Birth Date</td>
                        <td>'.preg_replace('/(....)(..)(..)/', '$3/$2/$1', $person['birth']['date']).'</td>
                    </tr>
                    <tr>
                        <td>Birth Location</td>
                        <td>'.$city.'</td>
                    </tr>
                   <tr>
                        <td>Birth Location Code</td>
                        <td>'.$code.'</td>
                    </tr>
                    <tr>
                        <td>Birth Postal Code</td>
                        <td>'.$codePostal.'</td>
                    </tr>
                    <tr>
                        <td>Birth Code History</td>
                        <td>'.$codeHistory.'</td>
                    </tr><tr>
                        <td>Birth Department Code</td>
                        <td>'.$departmentCode.'</td>
                    </tr><tr>
                        <td>Birth Country</td>
                        <td>'.$country.'</td>
                    </tr><tr>
                        <td>Birth Country code</td>
                        <td>'.$countryCode.'</td>
                    </tr><tr>
                        <td>Birth Latitude</td>
                        <td>'.$latitude.'</td>
                    </tr><tr>
                        <td>Birth Longitude</td>
                        <td>'.$longitude.'</td>
                    </tr><tr>
                        <td>Certificate ID</td>
                        <td>'.$certificateId.'</td>
                    </tr><tr>
                        <td>Age</td>
                        <td>'.$age.'</td>
                    </tr>

                      <tr>
                        <td>Death Location</td>
                        <td>'.$death_city.'</td>
                    </tr>
                   <tr>
                        <td>Death Location Code</td>
                        <td>'.$death_code.'</td>
                    </tr>
                    <tr>
                        <td>Death Postal Code</td>
                        <td>'.$death_codePostal.'</td>
                    </tr>
                    <tr>
                        <td>Death Code History</td>
                        <td>'.$death_codeHistory.'</td>
                    </tr><tr>
                        <td>Death Department Code</td>
                        <td>'.$death_departmentCode.'</td>
                    </tr><tr>
                        <td>Death Country</td>
                        <td>'.$death_country.'</td>
                    </tr><tr>
                        <td>Death Country code</td>
                        <td>'.$death_countryCode.'</td>
                    </tr><tr>
                        <td>Death Latitude</td>
                        <td>'.$death_latitude.'</td>
                    </tr>
                    <tr>
                        <td>Death Longitude</td>
                        <td>'.$death_longitude.'</td>
                    </tr>
                    <tr>
                        <td>Source</td>
                        <td>'.$source.'</td>
                    </tr>
                    <tr>
                        <td>Source Line</td>
                        <td>'.$sourceLine.'</td>
                    </tr>
                    <tr>
                        <td>Score</td>
                        <td>'.$score.'</td>
                    </tr>
                    <tr>
                        <td>ES</td>
                        <td>'.$es.'</td>
                    </tr>
                    

                    </tbody>
                </table><br/></div>';
            }
        } else {
            echo "<p>No results found.</p>";
        }
    } else {
        echo "<p>Error fetching data. Check if API access is allowed.</p>";
    }
} else {
    echo "<p>Invalid query.</p>";
}
?>
