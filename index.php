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

echo "<html>\n";

echo "  <head>\n";
echo "    <title>Knivhelg - Kniva en Admin!</title>\n";
echo "    <link rel='stylesheet' type='text/css' href='css/default.css'>\n";

/* JQUERY */
echo "    <script src='https://code.jquery.com/jquery-3.6.0.min.js' integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=' crossorigin='anonymous'></script>\n";

/* METAREFRESH */
echo "    <meta http-equiv='refresh' content='120'>\n";

/* BOOTSTRAP */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>\n";

/* DATATABLES */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css'>\n";

echo "  </head>\n";

echo "  <body style='background-color:#282828; color:#EFEFEF'>\n";

  
/* HEADER */
echo "    <div id='header' class='container-fluid'>\n";
echo "      <div id='logo'>\n";
echo "        <a href='index.php'><img src='images/oldswedes.logo.motto.small.png' alt='My Logo' /></a>\n";
echo "      </div>\n";
echo "    </div>\n";


/* CONTENT LEFT*/
echo "    <div id='content' class='container-fluid'>\n";
echo "      <div id='content-main' class='container'>\n";
echo "        <h2 style='color:#fbb204'>Knivhelg - Kniva en Admin!</h2>\n";
echo "        <p style='font-size:14px'>Admin-Jaktsäsongen på OldSwedes har startat!, Efter Jul och nyår har våra admins blivit fullproppade med mat och godsaker, så det är dags att få dem att springa av sig lite :)<br>\n";
echo "        dock är det enda sättet att få tyst på dem odågorna att kniva dem i ryggen :D Som belöning får ni 10 poäng per admin, men ni får också 5p för andra spelare<br>\n";
echo "        Notera att admins kan få för sig att kniva tillbaka :)</p>\n";
echo "        <p style='font-size:14px'>Lycka till!</p>\n";
echo "        <p style='font-size:14px'>(Notera att detta är i beta och det kan därför finnas buggar)</p>\n";

echo "        <div id='content-main-inner' class='row'>\n";
echo "          <div id='content-left' class='col col-2'>\n";
echo "              <h4 style='color:#fbb204'>Poäng:</h4>\n";
echo "              <ul>\n";
echo "                  <li>10p - admin</li>\n";
echo "                  <li>5p - spelare</li>\n";
echo "              </ul>\n";
echo "              <h4 style='color:#fbb204'>Kommandon:</h4>\n";
echo "              <ul>\n";
echo "                  <li>!ktop - visa top10</li>\n";
echo "              </ul>\n";
echo "          </div>\n";

echo "          <div id='content-middle' class='col col-6'>\n";
echo "            <h4 style='color:#fbb204'>Senaste händelserna</h4>\n";
echo "             <table id='eventlist' class='table table-dark table-striped table-bordered'>\n";

echo "              <thead>\n";
echo "                <tr>\n";
echo "                  <th class='col-3'>Time</th>\n";
echo "                  <th class='col-4'>Attacker</th>\n";
echo "                  <th class='col-4'>Victim</th>\n";
echo "                </tr>\n";
echo "              </thead>\n";

echo "              <tbody>\n";

$eList = getEventList ( );
foreach ( $eList->getArray() as $event ) {
    $isTeamKill = ( $event->getType() == 1 );
    $rowClass = "";
    if ( $isTeamKill ) {
        $rowClass = "class='red'";
    }
    echo "                <tr ".$rowClass.">\n";
    echo "                  <td class='col-3'>".$event->getStamp()."</td>\n";
    echo "                  <td class='col-4'>".$event->getAttacker()." [+".$event->getPoints()."p]</td>\n";
    echo "                  <td class='col-4'>".$event->getVictim()." [-".$event->getPoints()."p]</td>\n";
    echo "                </tr>\n";
}

echo "              </tbody>\n";
echo "            </table>\n";
echo "          </div>\n";

/* CONTENT RIGHT */
echo "          <div id='content-right' class='col col-3'>\n";
echo "            <h4 style='color:#fbb204'>Topplista</h4>\n";
echo "            <table id='userlist' class='table table-dark table-striped table-bordered'>\n";

echo "              <thead>\n";
echo "                <tr>\n";
echo "                  <th class='col-1'>Rank</th>\n";
echo "                  <th class='col-4'>Name</th>\n";
echo "                  <th class='col-2'>Points</th>\n";
echo "                </tr>\n";
echo "              </thead>\n";

echo "              <tbody>\n";

$uList = getUserListSorted ( );
$index = 0;
foreach ( $uList->getArray() as $user ) {
    echo "                <tr>\n";
    echo "                  <td class='col-1'>#".++$index."</td>\n";
    echo "                  <td class='col-4'>".$user->getName()."</td>\n";
    echo "                  <td class='col-2'>".$user->getPoints()."</td>\n";
    echo "                </tr>\n";
}

echo "              </tbody>\n";
echo "            </table>\n";

echo "          </div>\n";
echo "        </div>\n";
echo "      </div>\n";

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
echo "            $(document).ready(function() {\n";
echo "              $('#eventlist').DataTable({\n";
echo "                'paging': false,\n";
echo "                'searching': true,\n";
echo "                'info': false,\n";
echo "                'order': [[ 0, 'desc' ]]\n";
echo "              });\n";
echo "            });\n";
echo "    </script>\n";
echo "  </body>\n";
echo "</html>\n";


?>