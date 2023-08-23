<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTimeZone;
use DateTime;

class basketballController extends Controller
{
    //
    function loadGames()
    {
        echo "                           
        <tr onclick='location.href =\"basketballfixture\"'>
        <td class='fontSize10px'>00:20</td>
        <td class='fontSize10px'>Zornotza ST</td>
        <td class='fontSize10px'>vs</td>
        <td class='fontSize10px'>Navarra</td>
        <td class='fontSize10px'>GG</td>
        <td class='fontSize10px'>1.50</td>
        <td colspan='2' class='fontSize10px'>
            <div class=' wid70 mx-auto'>
                <div class='d-flex justify-content-between'>
                    <img src='" . asset('icons/1xbet.png') . "' alt=''>
                    <img src='" . asset('icons/bet9ja.png') . "' alt=''>
                    <!-- <img src='" . asset('icons/sportyBet.png') . "' alt=''> -->
                </div>
            </div>
        </td>
    </tr>";
    }


    public static function countries()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-basketball.p.rapidapi.com/countries',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response) || empty(json_decode($response)->response)) {
            $responses = "error";
        } else {
            $responses = json_decode($response);
        }

        if ($responses == 'error') {
            echo "<p class=' errorMsgBg p-3 white boldSix mt-4 wid80 centerText d-block mx-auto' role='alert'>No Games Available Today</p>";
        } else {
            foreach ($responses->response as $country) {
                // echo "
                // <a href='$country->id' class='wid100 country bodyA d-block boldFive p-2 marginY fontSize12px bgWhite' onclick='event.preventDefault(); $.ajax({url: \"loadLeaguesBasket/" . $country->id . "\" , type: \"GET\", success: (data) => {
                //     $(\"#bodyVal\").html(data); }
                // })' id='ahref-link-" . $country->id . "' ><img src='" . $country->flag . "'class='wid16px'  alt=''> " . $country->name . "</a>

                // ";

?>
                <a href="<?php echo $country->code ?>" class="wid100 country bodyA d-block boldFive p-2 marginY fontSize12px bgWhite" onclick="event.preventDefault();  
                $.ajax({
                    url: 'loadLeaguesBasket/<?php echo strval($country->id) ?>',
                    type: 'GET', 
                    success: (data) => {
                     $('#bodyVal').html(data);
                    }
                });   
                $('html, body').animate({
                        scrollTop: 20
                }, 'slow');" id="ahref-link- <?php echo $country->code ?>"><img src="<?php echo $country->flag ?>" class="wid16px" alt=""><?php echo $country->name ?></a>
<?php
            }
        }
    }

    public static function Statistics($league, $team)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/statistics?league=$league&team=$team&season=2022-2023",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $responses = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        if (!isset(json_decode($responses)->response->games->wins->all->percentage) || empty(json_decode($responses)->response->games->wins->all->percentage)) {
            return "no predictions";
        }
        return json_decode($responses)->response->games->wins->all->percentage;
    }

    public static function standingCal($league, $teamOne, $teamTwo)
    {
        if (self::Statistics($league, $teamOne) >= self::statistics($league, $teamTwo)) {
            return 1;
        }
        return 2;
    }
    public static function standingCalTwo($league, $teamOne, $teamTwo)
    {
        if (self::standingCal($league, $teamOne, $teamTwo) == 1) {
            return "home win";
        } else {
            return "away win";
        }
    }



    public static function ScoreCalculator($teamId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-basketball.p.rapidapi.com/standings?league=12&team=' . $teamId . '&season=2022-2023',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com',
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (!isset(json_decode($response)->response[0][0])) {
            $response =  "Error";
        } else {
            $gamesPlayed = json_decode($response)->response[0][0]->games->played;
            $points = json_decode($response)->response[0][0]->points->for;
            $response = round($points / $gamesPlayed);
        }
        return $response;
    }


    public static function GameCal($home, $away)
    {
        return self::ScoreCalculator($home) == "Error" ? "no prediction" : intval(self::ScoreCalculator($home)) + intval(self::ScoreCalculator($away));
    }





    public static function leagues($countryId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/leagues?country_id=$countryId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response) || empty(json_decode($response)->response)) {
            $responses = "error";
        } else {
            $responses = json_decode($response);
        }

        if ($responses == 'error') {
            echo "<p class=' errorMsgBg p-3 white boldSix mt-4 wid80 centerText d-block mx-auto' role='alert'>No Games Available Today</p>";
        } else {
            $gameUI = "
            <p class='bgBlackKsb boldFive fontSize14px white p-2 m-1'><img src='" . $responses->response[0]->country->flag . "'class='wid16px'  alt=''> " . $responses->response[0]->country->name . "</p>
            ";
            foreach ($responses->response as $league) {
                $gameUI .= "
                <a href='/leagueBasketball/" . $league->id . "' class='wid100 league bodyA d-block boldFive p-2 m-2 shadow-sm fontSize12px bgWhite' onclick='event.preventDefault(); loadGamesBasket(" . $league->id . ");' id='ahref-link-" . $league->type . "' ><img src='" . $league->logo . "'class='wid16px'  alt=''> " . $league->name . "</a>
                ";
            }
            echo $gameUI;
        }
    }


    public static function loadLeagueGames($leagueId)
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $lastYear = date('Y', strtotime("-1 year"));
        $thisYear = date('Y');
        $nextYear = date('Y', strtotime("+1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/games?league=$leagueId&season=$lastYear-$thisYear&date=$tomorrow",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response) || empty(json_decode($response)->response)) {
            $responses = "error";
        } else {
            $responses = json_decode($response);
        }

        if ($responses == 'error') {
            echo "   
            <tr>
            <td colspan='8'>
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            $gameUI = "";
            $gameUI .= "<div class='table-responsive shadow mb-4'>
            <table class='table table-hover'>
                <thead>
                    <tr class='bgShaddyWhite'>
                        <td colspan='8' class='white'><img class='wid16px' src='" . $responses->response[0]->league->logo . "' alt=''> " . $responses->response[0]->country->name . ": " . $responses->response[0]->league->name . "</td>
                    </tr>
                    <tr class='boldFour'>
                        <td colspan='4' class='fontSize10px'>Events</td>
                        <td class='fontSize10px'>Tip</td>
                        <td class='fontSize10px centerText'>Odd
                        <div class='d-flex justify-content-between'>
                            <span>1</span>
                            <span>X</span>
                            <span>2</span>
                         </div>
                        </td>
                        <td colspan='2'></td>
                    </tr>
                </thead>
                <tbody>
                ";
            foreach ($responses->response as $team) {
                $gameUI .= "    
                <tr  class='pointers'>
                <td class='fontSize10px'>" . self::changeTimeZone($team->timezone, $team->date) . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::standingCal($team->league->id, $team->teams->home->id, $team->teams->away->id) . "</td>
                <td class='fontSize10px'>" . self::odd($team->id) . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;' target='_blank'  ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class=''  target='_blank' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;'> Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
            $gameUI .= "
            </tbody>
            </table>
            </div>";
            echo $gameUI;
        }
    }




    public static function loadSpainLeague()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $lastYear = date('Y', strtotime("-1 year"));
        $thisYear = date('Y');
        $nextYear = date('Y', strtotime("+1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/games?league=117&season=$lastYear-$thisYear&date=$tomorrow",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response) || empty(json_decode($response)->response)) {
            $responses = "error";
        } else {
            $responses = json_decode($response);
        }

        if ($responses == 'error') {
            echo "   
            <tr>
            <td colspan='8'>
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr  class='pointers'>
                <td class='fontSize10px'>" . self::changeTimeZone($team->timezone, $team->date) . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::standingCal($team->league->id, $team->teams->home->id, $team->teams->away->id) . "</td>
                <td class='fontSize10px'>" . self::odd($team->id) . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;' target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;' target='_blank' > Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
        }
    }


    public static function loadNbaGames()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $lastYear = date('Y', strtotime("-1 year"));
        $thisYear = date('Y');
        $nextYear = date('Y', strtotime("+1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/games?league=12&season=$lastYear-$thisYear&date=$tomorrow",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response) || empty(json_decode($response)->response)) {
            $responses = "error";
        } else {
            $responses = json_decode($response);
        }

        if ($responses == 'error') {
            echo "   
            <tr>
            <td colspan='8'>
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr  class='pointers'>
                <td class='fontSize10px'>" . self::changeTimeZone($team->timezone, $team->date) . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::standingCal($team->league->id, $team->teams->home->id, $team->teams->away->id) . "</td>
                <td class='fontSize10px'>" . self::odd($team->id) . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;'  target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;' target='_blank' > Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
        }
    }


    public static function loadChinaGames()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $lastYear = date('Y', strtotime("-1 year"));
        $thisYear = date('Y');
        $nextYear = date('Y', strtotime("+1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/games?league=31&season=$lastYear-$thisYear&date=$tomorrow",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response) || empty(json_decode($response)->response)) {
            $responses = "error";
        } else {
            $responses = json_decode($response);
        }

        if ($responses == 'error') {
            echo "   
            <tr>
            <td colspan='8'>
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr  class='pointers'>
                <td class='fontSize10px'>" . self::changeTimeZone($team->timezone, $team->date) . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::standingCal($team->league->id, $team->teams->home->id, $team->teams->away->id) . "</td>
                <td class='fontSize10px'>" . self::odd($team->id) . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;' target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;' target='_blank' > Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
        }
    }




    public static function loadUkraineGames()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $lastYear = date('Y', strtotime("-1 year"));
        $thisYear = date('Y');
        $nextYear = date('Y', strtotime("+1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/games?league=106&season=$lastYear-$thisYear&date=$tomorrow",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response) || empty(json_decode($response)->response)) {
            $responses = "error";
        } else {
            $responses = json_decode($response);
        }

        if ($responses == 'error') {
            echo "   
            <tr>
            <td colspan='8'>
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr  class='pointers'>
                <td class='fontSize10px'>" . self::changeTimeZone($team->timezone, $team->date) . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/basketfix/" . $team->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::standingCal($team->league->id, $team->teams->home->id, $team->teams->away->id) . "</td>
                <td class='fontSize10px'>" . self::odd($team->id) . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;' target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;' target='_blank' > Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
        }
    }






    public static function odd($fixtureId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/odds?game=$fixtureId&bookmaker=3",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if (!isset(json_decode($response)->response[0])) {
            $responses = "not Available";
        } else {
            $resp = json_decode($response)->response[0]->bookmakers[0]->bets[0];
            $responses = "
               <div class='d-flex justify-content-between'> 
               <p class='m-sm-0 m-1'>" . $resp->values[0]->odd . "</p>
               <p class='m-sm-0 m-1'>" . $resp->values[1]->odd . "</p>
               <p class='m-sm-0 m-1'>" . $resp->values[2]->odd . "</p>
               ";
        }
        return $responses;
    }



    public static function fixturesGames($fixtureId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/games?id=$fixtureId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (!isset(json_decode($response)->response[0])) {
            echo "<p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>";
        } else {
            $team = json_decode($response)->response[0];
            echo "
        <p class='white fontSize12px boldFive wid100 bgShaddyWhite p-2'><img src='" . $team->country->flag  . "' class='me-2 wid16px' alt=''> " . $team->country->name . " : " . $team->country->name . "</p>
        <div class='wid100 p-2'>
            <div class='d-block bgSocials wid100 mx-auto mt-5'>
                <div class='d-block wid100Mobile wid75 mx-auto'>           
                <div class='d-flex p-2 justify-content-between align-items-center'>
                    <div class='d-flex align-items-center'>
                        <span class='fontSize24px socialColorDeeper boldFive centerText'>" . $team->teams->home->name . "</span>
                        <div class='d-lg-flex align-items-center ms-2 d-none'>
                        " . self::showStandingsCal($team->teams->home->id, $team->league->id) . "
                        </div>
                    </div>
                    <span class='boldFour bodyA mx-4 fontSize12px'>" . self::changeTimeZoneFixture($team->timezone, $team->date) . "</span>
                    <div class='d-flex align-items-center'>
                        <div class='d-lg-flex align-items-center me-3  d-none'>
                        " . self::showStandingsCal($team->teams->away->id, $team->league->id) . "
                        </div>
                        <span class='fontSize24px socialColorDeeper boldFive'>" . $team->teams->away->name . "</span>
                    </div>
                </div>
           </div>
           </div>
           <div class='flex justify-content-center m-5'>
               <span class='fontSize14px bodyA ms-3 boldFour'>Prediction</span>
               <span class='fontSize14px socialColorDeeper ms-3 boldFive'>   " . self::GameCal($team->teams->home->id, $team->teams->away->id) . "</span>
               <span class='fontSize14px socialColorDeeper ms-3 boldFive'>" . self::standingCalTwo($team->league->id, $team->teams->home->id, $team->teams->away->id) . "</span>
           </div>
           <p class='fontSize12px boldFive p-2 bgSocials socialColorDeeper'>Head to Head</p>
        " . self::headTwoHead($team->teams->home->id, $team->teams->away->id) . "

        </div>
        <div class='wid100 bgSocials p-3'>
        <p class='fontSize12px boldFive '>Bet on this match on</p>
        <div class='d-flex flex-wrap justify-content-between'>
            <img src='" . asset('icons/bookmarks/btway.png') . "' class='wid45px' alt=''>
            <img src='" . asset('icons/bookmarks/everygame.png') . "' class='wid45px' alt=''>
            <img src='" . asset('icons/bookmarks/22b.png') . "' class='wid45px' alt=''>
            <img src='" . asset('icons/bookmarks/1win.png') . "' class='wid45px' alt=''>
            <img src='" . asset('icons/bookmarks/1xb.png') . "' class='wid45px' alt=''>
        </div>
    </div>
    <div class='bgWhite d-flex flex-wrap justify-content-between wid100 py-3 px-1 py-sm-5'>
    " . self::showWins($team->teams->home->id, $team->league->id) . "
    " . self::showWins($team->teams->away->id, $team->league->id) . "
    </div>
            ";
        }
    }


    public static function showStandings($teamId, $leagueId)
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $lastYear = date('Y', strtotime("-1 year"));
        $thisYear = date('Y');
        $nextYear = date('Y', strtotime("+1 year"));
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api-basketball.p.rapidapi.com/standings?team=$teamId&season=$lastYear-$thisYear&league=$leagueId",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
        //         'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
        //     ),
        // ));

        // $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/standings?team=$teamId&season=2022-2023&league=$leagueId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        //  return json_decode($response)->response[0][0]->form;



        if (!isset(json_decode($response)->response[0][0]->form) || json_decode($response)->response[0][0]->form == null) {
            $responses = "";
        } else {
            $responses = str_split(json_decode($response)->response[0][0]->form);
        }

        return $responses;
    }

    public static function showWins($teamId, $leagueId)
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $lastYear = date('Y', strtotime("-1 year"));
        $thisYear = date('Y');
        $nextYear = date('Y', strtotime("+1 year"));


        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/standings?team=$teamId&season=2022-2023&league=$leagueId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        //  return json_decode($response)->response[0][0]->form;



        if (!isset(json_decode($response)->response[0][0]) || json_decode($response)->response[0][0] == null) {
            $responses = "";
        } else {
            $team = json_decode($response)->response[0][0];
            $responses = "   
            <div class='wid45 wid100Mobile'>
                <span class='fontSize12px d-block boldFive p-2 bgSocials socialColorDeeper'>" . $team->team->name . ": Last results</span>
                <div class='d-flex my-1 justify-content-between p-2 align-items-center shadow-sm'>
                    <div class='d-flex align-items-center'>
                        <span class='fontSize12px me-3 padSmall7 borderRA1 white boldFive standingGreen'>W</span>
                        <span class='blackKsbTwo fontSize10px noWrap'>" . $team->games->win->total . "</span>
                    </div>
                </div>
                <div class='d-flex my-1 justify-content-between p-2 align-items-center shadow-sm'>
                <div class='d-flex align-items-center'>
                    <span class='fontSize12px me-3 padSmall7 borderRA1 white boldFive standingRed'>L</span>
                    <span class='blackKsbTwo fontSize10px noWrap'>" . $team->games->lose->total . "</span>
                </div>
              </div>
            </div>";
        }

        return $responses;
    }



    public static function showStandingsCal($team, $leagueId)
    {
        $responseHtml = "";
        $stand = self::showStandings($team, $leagueId);
        if (is_array($stand)) {
            foreach ($stand as $sta) {
                if ($sta == "O") {
                    $responseHtml .= "<span class='fontSize6px marginRightStandings padSmall7 borderRA1 white boldFive standingGrey'>O</span>";
                } else if ($sta == "L") {
                    $responseHtml .=  "<span class='fontSize6px marginRightStandings padSmall7 borderRA1 white boldFive standingRed'>L</span>
                    ";
                } else {
                    $responseHtml .= "<span class='fontSize6px marginRightStandings padSmall7 borderRA1 white boldFive standingGreen'>W</span>";
                }
            }
        } else {
            $responseHtml .= "no standing";
        }
        return $responseHtml;
    }


    public static function headTwoHead($homeId, $awayId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-basketball.p.rapidapi.com/games?h2h=$homeId-$awayId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-basketball.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);
        $responses = "";
        curl_close($curl);
        // echo $response;
        if (!isset(json_decode($response)->response[0])) {
            $response .=  "<p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>";
        } else {
            $respons = json_decode($response)->response;
            foreach ($respons as $data) {
                $responses .= "
            <div class='d-block wid100 rounded-pill p-2 m-1 shadow-sm' style='overflow: hidden;'>
               <div class='ms-3 ms-sm-5 d-flex justify-content-between align-items-center wid40 wid30Mobile'>
                <span class='fontSize10px noWrap bodyA boldFour'>" . self::changeTimeZoneTwo($data->timezone, $data->date) . " </span>
                <span class='fontSize12px socialColorDeeper noWrap boldFour'> " . $data->teams->home->name . "</span>
                <span class='fontSize14px socialColorDeeper noWrap boldFive'> " . $data->scores->home->total . " : " . $data->scores->away->total . "</span>
                <span class='fontSize12px noWrap socialColorDeeper boldFour'> " . $data->teams->away->name . "</span>
              </div>
            </div>
           ";
            }
            return $responses;
        }
    }


    public static function changeTimeZone($timeZone, $time)
    {
        $times = date($time);
        $defaultTimeZone = new DateTimeZone($timeZone);
        $newTime = new DateTime($times, $defaultTimeZone);
        $setTimeZone = new DateTimeZone("Africa/Lagos");
        $newTime->setTimeZone($setTimeZone);
        return $newTime->format('m-d  H:i');
    }

    public static function changeTimeZoneTwo($timeZone, $time)
    {
        $times = date($time);
        $defaultTimeZone = new DateTimeZone($timeZone);
        $newTime = new DateTime($times, $defaultTimeZone);
        $setTimeZone = new DateTimeZone("Africa/Lagos");
        $newTime->setTimeZone($setTimeZone);
        return $newTime->format('d.m.Y');
    }
    // Statistics will be used to predict the game winner for the table data.
    public static function changeTimeZoneFixture($timeZone, $time)
    {
        $times = date($time);
        $defaultTimeZone = new DateTimeZone($timeZone);
        $newTime = new DateTime($times, $defaultTimeZone);
        $setTimeZone = new DateTimeZone("Africa/Lagos");
        $newTime->setTimeZone($setTimeZone);
        return $newTime->format('H:i');
    }
}
