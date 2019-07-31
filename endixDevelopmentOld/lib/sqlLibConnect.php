<?php
##########################################################
#                                                        #
#  Auto-Link For PHP-Libraries by Tobias Hattinger       #
#                     Ver 1.0.0                          #
#                                                        #
# https://github.com/TobiHatti/PHP-Library-Collection    #
#                                                        #
#########################################################

#########################################################
#       Enter your MySQ-Connection Infos in here:       #
#########################################################

// Database hostname
$databaseHostname = "localhost";          

// Database username
$databaseUsername = "u94925db3";

// Database Password
$databasePassword = "cq64EN!l4G-";

// Database Name
$databaseName = "u94925db3";

#########################################################
#       Change nothing from here on out                 #
#########################################################

// Creating the link to the MySQL-Database
$databaseConnectionLink = mysqli_connect($databaseHostname,$databaseUsername,$databasePassword,$databaseName) or die("<br><br><b>Error in sqlLibConnect.php :</b> Could not connect to Database. Check your connection-Data and try again<br><br>");


// Auto-Link for MySQL.lib
// https://github.com/TobiHatti/PHP-Library-Collection/tree/master/objectoriented-style/mysql.lib
    if(class_exists("MySQL")) MySQL::SetSQLLink($databaseConnectionLink,$databaseHostname,$databaseUsername,$databasePassword,$databaseName);

// Auto-Link for Dynload.lib
// https://github.com/TobiHatti/PHP-Library-Collection/tree/master/objectoriented-style/dynload.lib
    if(class_exists("DynLoad")) DynLoad::SetSQLLink($databaseConnectionLink);

// Auto-Link for Pager.lib
// https://github.com/TobiHatti/PHP-Library-Collection/tree/master/objectoriented-style/pager.lib
    if(class_exists("Pager")) Pager::SetSQLLink($databaseConnectionLink);

// Auto-Link for Setting.lib
// https://github.com/TobiHatti/PHP-Library-Collection/tree/master/objectoriented-style/setting.lib
    if(class_exists("Setting")) Setting::SetSQLLink($databaseConnectionLink);

// Auto-Link for Upload.lib
// https://github.com/TobiHatti/PHP-Library-Collection/tree/master/objectoriented-style/upload.lib
    if(class_exists("Upload")) Upload::SetSQLLink($databaseConnectionLink);


?>