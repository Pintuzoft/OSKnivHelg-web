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

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function steamProfileUrl($steamid64) {
    return 'https://steamcommunity.com/profiles/' . rawurlencode((string)$steamid64);
}

function renderSteamName($name, $steamid64) {
    $safeName = e($name);
    $steamid64 = (string)$steamid64;

    if (preg_match('/^[0-9]{17}$/', $steamid64) !== 1) {
        return $safeName;
    }

    return "<a class='steam-link' href='" . steamProfileUrl($steamid64) . "' target='_blank' rel='noopener noreferrer'>" . $safeName . "</a>";
}

function renderHeader() {
    echo "<!doctype html>\n";
    echo "<html lang='sv'>\n";
    echo "  <head>\n";
    echo "    <meta charset='utf-8'>\n";
    echo "    <meta name='viewport' content='width=device-width, initial-scale=1'>\n";
    echo "    <meta http-equiv='refresh' content='120'>\n";
    echo "    <title>Knivhelg - Kniva en Admin!</title>\n";
    echo "    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>\n";
    echo "    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css'>\n";
    echo "    <link rel='stylesheet' type='text/css' href='css/default.css'>\n";
    echo "    <script src='https://code.jquery.com/jquery-3.6.0.min.js' integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=' crossorigin='anonymous'></script>\n";
    echo "  </head>\n";
    echo "  <body>\n";
    echo "    <div class='page-shell'>\n";
    echo "      <header class='site-header'>\n";
    echo "        <a class='brand' href='index.php'><img src='images/oldswedes.logo.motto.small.png' alt='OldSwedes'></a>\n";
    echo "        <div class='hero-text'>\n";
    echo "          <div class='eyebrow'>OldSwedes CS2 Event</div>\n";
    echo "          <h1>Knivhelg</h1>\n";
    echo "          <p>Kniva en admin, samla poäng och klättra på topplistan.</p>\n";
    echo "        </div>\n";
    echo "      </header>\n";
}

function renderIntro($stats) {
    $totalEvents = (int)$stats['total_events'];
    $totalPlayers = (int)$stats['total_players'];
    $totalPoints = (int)$stats['total_points'];
    $topName = $stats['top_name'] !== null ? e($stats['top_name']) : '-';
    $topPoints = $stats['top_points'] !== null ? (int)$stats['top_points'] : 0;

    echo "      <main class='content-wrap'>\n";
    echo "        <section class='intro-card'>\n";
    echo "          <div>\n";
    echo "            <h2>Kniva en Admin!</h2>\n";
    echo "            <p>Glad Valborg! Vi kör knivhelg, så vässa kniven och jaga poäng på topplistan.</p>\n";
    echo "            <p>Inga minuspoäng ges om man blir knivad, men teamkill med kniv kostar. Förstås. Det är ju inte välgörenhet heller.</p>\n";
    echo "          </div>\n";
    echo "          <div class='rules-box'>\n";
    echo "            <h3>Poäng</h3>\n";
    echo "            <ul>\n";
    echo "              <li><span>10p</span> kniva admin</li>\n";
    echo "              <li><span>5p</span> kniva spelare</li>\n";
    echo "              <li><span>-p</span> knife-teamkill</li>\n";
    echo "            </ul>\n";
    echo "            <h3>Kommandon</h3>\n";
    echo "            <ul><li><span>!ktop</span> visa top 10</li></ul>\n";
    echo "          </div>\n";
    echo "        </section>\n";
    echo "        <section class='stat-grid'>\n";
    echo "          <div class='stat-card'><span>Events</span><strong>" . $totalEvents . "</strong></div>\n";
    echo "          <div class='stat-card'><span>Spelare</span><strong>" . $totalPlayers . "</strong></div>\n";
    echo "          <div class='stat-card'><span>Poäng totalt</span><strong>" . $totalPoints . "</strong></div>\n";
    echo "          <div class='stat-card'><span>Ledare</span><strong>" . $topName . "</strong><small>" . $topPoints . "p</small></div>\n";
    echo "        </section>\n";
}

function renderEventTable($eList) {
    echo "        <section class='panel panel-events'>\n";
    echo "          <div class='panel-heading'><div><h2>Senaste händelserna</h2><p>Automatiskt uppdaterad varannan minut.</p></div></div>\n";
    echo "          <div class='table-responsive'>\n";
    echo "            <table id='eventlist' class='table table-dark table-hover align-middle'>\n";
    echo "              <thead><tr><th>Tid</th><th>Attacker</th><th>Victim</th><th>Info</th></tr></thead>\n";
    echo "              <tbody>\n";

    foreach ($eList->getArray() as $event) {
        $isTeamKill = ((int)$event->getType() === 1);
        $isInvalidated = ((int)$event->getType() === 2);
        $rowClass = '';
        $info = '';

        if ($isTeamKill) {
            $rowClass = 'event-tk';
            $info = "<span class='badge badge-tk'>TK</span>";
        } else if ($isInvalidated) {
            $rowClass = 'event-invalid';
            $info = "<span class='badge badge-invalid'>Invalid</span>";
        }

        $attacker = renderSteamName($event->getAttacker(), $event->getAttackerSteamId64());
        $victim = renderSteamName($event->getVictim(), $event->getVictimSteamId64());
        $points = (int)$event->getPoints();

        echo "                <tr class='" . $rowClass . "'>\n";
        echo "                  <td class='event-time'>" . e($event->getStamp()) . "</td>\n";

        if ($isTeamKill) {
            echo "                  <td>" . $attacker . " <span class='points points-minus'>-" . $points . "p</span></td>\n";
            echo "                  <td>" . $victim . " <span class='points points-plus'>+" . $points . "p</span></td>\n";
        } else if ($isInvalidated) {
            echo "                  <td>" . $attacker . " <span class='points points-muted'>+" . $points . "p</span></td>\n";
            echo "                  <td>" . $victim . "</td>\n";
        } else {
            echo "                  <td>" . $attacker . " <span class='points points-plus'>+" . $points . "p</span></td>\n";
            echo "                  <td>" . $victim . "</td>\n";
        }

        echo "                  <td>" . $info . "</td>\n";
        echo "                </tr>\n";
    }

    echo "              </tbody>\n";
    echo "            </table>\n";
    echo "          </div>\n";
    echo "        </section>\n";
}

function renderLeaderboard($uList) {
    echo "        <section class='panel panel-leaderboard'>\n";
    echo "          <div class='panel-heading'><div><h2>Topplista</h2><p>Poängkungar och knivterrorister.</p></div></div>\n";
    echo "          <div class='table-responsive'>\n";
    echo "            <table id='userlist' class='table table-dark table-hover align-middle'>\n";
    echo "              <thead><tr><th>#</th><th>Namn</th><th>Poäng</th></tr></thead>\n";
    echo "              <tbody>\n";

    $rank = 0;
    foreach ($uList->getArray() as $user) {
        $rank++;
        $medalClass = $rank <= 3 ? 'rank-medal rank-' . $rank : 'rank-medal';
        $name = renderSteamName($user->getName(), $user->getSteamId64());
        $points = (int)$user->getPoints();

        echo "                <tr>\n";
        echo "                  <td><span class='" . $medalClass . "'>#" . $rank . "</span></td>\n";
        echo "                  <td>" . $name . "</td>\n";
        echo "                  <td><strong>" . $points . "p</strong></td>\n";
        echo "                </tr>\n";
    }

    echo "              </tbody>\n";
    echo "            </table>\n";
    echo "          </div>\n";
    echo "        </section>\n";
}

function renderFooter() {
    echo "      </main>\n";
    echo "      <footer class='site-footer'><span>OldSwedes Knivhelg</span><span>SteamID64-ready</span></footer>\n";
    echo "    </div>\n";
    echo "    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>\n";
    echo "    <script type='text/javascript' src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>\n";
    echo "    <script type='text/javascript' src='https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js'></script>\n";
    echo "    <script type='text/javascript'>\n";
    echo "      $(document).ready(function() {\n";
    echo "        $('#eventlist').DataTable({ paging: false, searching: true, info: false, order: [[0, 'desc']] });\n";
    echo "      });\n";
    echo "    </script>\n";
    echo "  </body>\n";
    echo "</html>\n";
}

$eList = getEventList();
$uList = getUserListSorted();
$stats = getDashboardStats();

renderHeader();
renderIntro($stats);
echo "        <div class='main-grid'>\n";
renderEventTable($eList);
renderLeaderboard($uList);
echo "        </div>\n";
renderFooter();
?>
