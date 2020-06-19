<?php
include("../libraries/WrapMySQL.php");
include("../data/dbConnect.php");

function GetGithubAPIResponse($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
    CURLOPT_TIMEOUT => 60,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HTTPHEADER => array(
        'Authorization: token '.getenv("GithubOAuth")
        )
    ]);

    return curl_exec($curl);
}


$sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass"));
$sql->Open();

foreach($sql->ExecuteQuery("SELECT * FROM projects") as $project)
{
    $apiQueryList = array(
    "General" => "https://api.github.com/repos/TobiHatti/".$project["GithubID"],
    "Releases" => "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/releases",
    "Issues" => "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/issues?state=all",
    "Languages" => "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/languages",
    "Readme" => "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/readme",
    "License" => "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/license",
    );

    foreach($apiQueryList as $key => $query)
    {
        if($sql->ExecuteScalar("SELECT COUNT(*) FROM apicache WHERE ProjectID = ? AND Request = ?", $project["ProjectID"], $key) == 0)
        {
            $sql->ExecuteNonQuery("INSERT INTO apicache (ProjectID, Request, URL, LastUpdate, APIResult) VALUES (?, ?, ?, NOW(), ?)", $project["ProjectID"], $key, $query, GetGithubAPIResponse($query));
        }
        else
        {
            $sql->ExecuteNonQuery("UPDATE apicache SET LastUpdate = NOW(), APIResult = ?, URL = ? WHERE ProjectID = ? AND Request = ?", GetGithubAPIResponse($query), $query, $project["ProjectID"], $key);
        }
    }
}

echo "OK";