<?php
date_default_timezone_set('Europe/Stockholm');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include_once 'class/config.php';
include_once 'class/mysql.php';
include_once 'class/arraylist.php';
include_once 'class/functions.php';
include_once 'class/event.php';
include_once 'class/user.php';

$mysql = new MySQL($mysql_host, $mysql_user, $mysql_password, $mysql_database);

echo "<html>\n";

echo "  <head>\n";
echo "    <title>My Title</title>\n";
echo "    <link rel='stylesheet' type='text/css' href='css/main.css'>\n";
echo "    <script type='text/javascript' src='js/jquery.js'></script>\n";

/* BOOTSTRAP */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>\n";

/* DATATABLES */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css'>\n";

echo "  </head>\n";

echo "  <body>\n";

/* HEADER */
echo "    <div id='header'>\n";
echo "      <div id='logo'>\n";
echo "        <a href='index.php'><img src='images/logo.png' alt='My Logo' /></a>\n";
echo "      </div>\n";

echo "      <div id='menu'>\n";
echo "        <ul>\n";
echo "          <li><a href='index.php'>Home</a></li>\n";
echo "          <li><a href='about.php'>About</a></li>\n";    
echo "          <li><a href='contact.php'>Contact</a></li>\n";
echo "        </ul>\n";
echo "      </div>\n";

echo "    </div>\n";


/* CONTENT */
echo "    <div id='content'>\n";
echo "      <table id='eventlist' class='table table-striped table-bordered' style='width:100%'>\n";

echo "        <thead>\n";
echo "          <tr>\n";
echo "            <th>Time</th>\n";
echo "            <th>Attacker</th>\n";
echo "            <th>Victim</th>\n";
echo "            <th>Points</th>\n";
echo "          </tr>\n";
echo "        </thead>\n";

echo "        <tbody>\n";

$eList = getEventList();
foreach ( $eList as $event ) {
    echo "          <tr>\n";
    echo "            <td>" . $eList->getTime ( ) . "</td>\n";
    echo "            <td>" . $eList->getAttacker ( ) . "</td>\n";
    echo "            <td>" . $eList->getVictim ( ) . "</td>\n";
    echo "            <td>" . $eList->getPoints ( ) . "</td>\n";
    echo "          </tr>\n";
}

echo "        </tbody>\n";

echo "    </div>\n";




/* FOOTER */ 
echo "    <div id='footer'>\n";
echo "      <div id='footer_content'>\n";
echo "      </div>\n";
echo "    </div>\n";

/* SCRIPTS */
echo "    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>\n";
echo "    <script type='text/javascript' src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>\n";
echo "    <script type='text/javascript' src='https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js'></script>\n";
echo "    <script type='text/javascript'>\n";
echo "      $(document).ready(function() {\n";
echo "        $('#eventlist').DataTable();\n";
echo "      });\n";
echo "    </script>\n";
echo "  </body>\n";
echo "</html>\n";


?>