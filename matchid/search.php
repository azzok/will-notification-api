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
        
        if (isset($data['response']['persons']) && count($data['response']['persons']) > 0) {
            foreach ($data['response']['persons'] as $person) {
                $lastName = htmlspecialchars($person['name']['last']);
                $firstName = htmlspecialchars($person['name']['first'][0]);
                $deathDate = $person['death']['date'];
                $formattedDate = preg_replace('/(....)(..)(..)/', '$3/$2/$1', $deathDate);

                echo "<div><small>Name: $lastName, First name: $firstName, died: $formattedDate</small></div>";
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
