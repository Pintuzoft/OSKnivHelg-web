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
echo "    <title>My Title</title>\n";
echo "    <link rel='stylesheet' type='text/css' href='css/main3.css'>\n";
echo "    <script type='text/javascript' src='js/jquery.js'></script>\n";

/* METAREFRESH */
echo "    <meta http-equiv='refresh' content='60'>\n";

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
echo "        <h2>Knivhelg - Kniva en Admin!</h2>\n";

echo "        <div id='content-main-inner' class='row'>\n";
echo "          <div id='content-left' class='col col-2'>\n";
echo "              <h4>Poäng:</h4>\n";
echo "              <ul>\n";
echo "                  <li>10p - admin</li>\n";
echo "                  <li>5p - spelare</li>\n";
echo "              </ul>\n";
echo "          </div>\n";

echo "          <div id='content-middle' class='col col-5'>\n";
echo "            <h4>Senaste händelserna</h4>\n";
echo "             <table id='eventlist' class='table table-dark table-striped table-bordered'>\n";

echo "              <thead>\n";
echo "                <tr>\n";
echo "                  <th>Time</th>\n";
echo "                  <th>Attacker</th>\n";
echo "                  <th>Victim</th>\n";
echo "                </tr>\n";
echo "              </thead>\n";

echo "              <tbody>\n";

$eList = getEventList ( );
foreach ( $eList->getArray() as $event ) {
    echo "                <tr>\n";
    echo "                  <td>".$event->getStamp()."</td>\n";
    echo "                  <td>".$event->getAttacker()." [+".$event->getPoints()."p]</td>\n";
    echo "                  <td>".$event->getVictim()." [-".$event->getPoints()."p]</td>\n";
    echo "                </tr>\n";
}

echo "              </tbody>\n";
echo "            </table>\n";
echo "          </div>\n";

/* CONTENT RIGHT */
echo "          <div id='content-right' class='col col-4'>\n";
echo "            <h4>Topplista</h4>\n";
echo "            <table id='userlist' class='table table-dark table-striped table-bordered'>\n";

echo "              <thead>\n";
echo "                <tr>\n";
echo "                  <th class='col-1'>Rank</th>\n";
echo "                  <th class='col-6'>Name</th>\n";
echo "                  <th class='col-2'>Points</th>\n";
echo "                </tr>\n";
echo "              </thead>\n";

echo "              <tbody>\n";

$uList = getUserListSorted ( );
$index = 0;
foreach ( $uList->getArray() as $user ) {
    echo "                <tr>\n";
    echo "                  <td class='col-1'>#".++$index."</td>\n";
    echo "                  <td class='col-6'>".$user->getName()."</td>\n";
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
echo "      $(document).ready(function() {\n";
echo "        $('#eventlist').DataTable();\n";
echo "      });\n";
echo "    </script>\n";
echo "  </body>\n";
echo "</html>\n";


?>