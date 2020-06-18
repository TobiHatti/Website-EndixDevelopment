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
    "https://api.github.com/repos/TobiHatti/".$project["GithubID"],
    "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/releases",
    "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/issues?state=all",
    "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/languages",
    "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/readme",
    "https://api.github.com/repos/TobiHatti/".$project["GithubID"]."/license",
    );

    foreach($apiQueryList as $query)
    {
        if($sql->ExecuteScalar("SELECT COUNT(*) FROM apicache WHERE ProjectID = ? AND URL = ?", $project["ProjectID"], $query) == 0)
        {
            $sql->ExecuteNonQuery("INSERT INTO apicache (ProjectID, URL, LastUpdate, APIResult) VALUES (?, ?, NOW(), ?)", $project["ProjectID"], $query, GetGithubAPIResponse($query));
        }
        else
        {
            $sql->ExecuteNonQuery("UPDATE apicache SET LastUpdate = NOW(), APIResult = ? WHERE ProjectID = ? AND URL = ?", GetGithubAPIResponse($query), $project["ProjectID"], $query);
        }
    }
}

echo "OK";