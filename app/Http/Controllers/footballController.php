<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class footballController extends Controller
{
    //
    public function loadGames()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?next=4",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: b1e1fe16-42e9-60b7-0f06-69d5f0a075b0",
                "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                "x-rapidapi-key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650"
            ),
        ));

        $response = curl_exec($curl);
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
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid60 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>
            ";
        } else {
            foreach ($responses->response as $team) {
                # code...

                echo "       
                <tr  class='pointers'>
                    <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' colspan='2' class='boldFour fontSize10px'><img src='" . $team->league->flag  . "' alt='' class='wid8px'> " . $team->league->country . " | " . self::changeTimeZone($team->fixture->timezone, $team->fixture->date) . " <br> <span class='boldFive fontSize12px'>" . $team->teams->home->name . " vs " . $team->teams->away->name . "</span>
                    </td>
                    <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='boldFive fontSize12px bgRed'>" . self::callPrediction($team) . "</td>
                    <td colspan='2' class='boldFive fontSize12px'>" . self::odd($team->fixture->id) . "</td>
                    <td>
                        <div class=' wid70 wid100Mobile mx-auto'>
                            <div class='d-flex align-items-center justify-content-between'>
                                <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                                <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;'   target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                                <a href='https://clcr.me/xsOTPT' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;' target='_blank' > Bet Now</a>
                                </div>
                             <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                                <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                            </div>
                        </div>
                    </td>
                </tr>
               ";
            }
        }
    }

    public function newsData($postId)
    {
        $bannerLong = DB::table('banner_uploads')->where('bannertype', 'long')->first();
        $news = DB::table('news_uploads')->where('id', $postId)->first();
        return view('newsDetails', ['bannerLong' => $bannerLong, 'news' => $news]);
    }
    public static function loadLeagueGames($leagueId)
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $lastYear = date('Y', strtotime("-1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?next=6&league=$leagueId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
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
                    <p class=' errorMsgBg p-3 white boldSix mt-4 wid80 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
                </td>
            </tr>";
        } else {
            $gameUI = "";
            $gameUI .= "<div class='table-responsive shadow mb-4'>
            <table class='table table-hover'>
                <thead>
                    <tr class='bgShaddyWhite'>
                        <td colspan='8' class='white'><img class='wid16px' src='" . $responses->response[0]->league->logo . "' alt=''> " . $responses->response[0]->league->country . ": " . $responses->response[0]->league->name . "</td>
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
                <td class='fontSize10px'>" . self::changeTimeZone($team->fixture->timezone, $team->fixture->date) . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::callPrediction($team) . "</td>
                <td class='fontSize10px'>" . self::odd($team->fixture->id) . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;'  ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;'> Bet Now</a>
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


    public static function loadEuropeGames()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $lastYear = date('Y', strtotime("-1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?date=$today&league=61&season=$lastYear",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
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
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid60 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr  class='pointers'>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . self::changeTimeZone($team->fixture->timezone, $team->fixture->date) . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . self::callPrediction($team) . "</td>
                <td class='fontSize10px'>" . self::odd($team->fixture->id) . "</td>
                <td class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;'  target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' target='_blank'  style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;'> Bet Now</a>
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
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/odds?fixture=$fixtureId&bet=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if (!isset(json_decode($response)->response[0]->bookmakers[0]->bets[0]->values[2]->odd)) {
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

    public static function loadAmericaGames()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $lastYear = date('Y', strtotime("-1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?date=$today&league=39&season=$lastYear",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
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
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid60 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='pointers'>
                <td class='fontSize10px'>" . self::changeTimeZone($team->fixture->timezone, $team->fixture->date) . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::callPrediction($team) . "</td>
                <td class='fontSize10px'>" . self::odd($team->fixture->id) . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;' target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' target='_blank'  style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;'> Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
        }
    }
    public static function loadSpainGames()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $lastYear = date('Y', strtotime("-1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?date=$today&league=140&season=$lastYear",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
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
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid60 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr class='pointers'>
                <td  class='fontSize10px'>" . self::changeTimeZone($team->fixture->timezone, $team->fixture->date) . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>vs</td>
                <td onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::callPrediction($team) . "</td>
                <td class='fontSize10px'>" . self::odd($team->fixture->id) . "</td>
                <td class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;' target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;' target='_blank'> Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
        }
    }
    public static function loadItalyGames()
    {
        $curl = curl_init();
        $today = date("Y-m-d");
        $lastYear = date('Y', strtotime("-1 year"));
        //$lastYear = date('Y');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?date=$today&league=135&season=$lastYear",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
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
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid60 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        } else {
            foreach ($responses->response as $team) {
                echo "    
                <tr onclick='location.href=\"/fixture/" . $team->fixture->id . "/" . $team->league->id . "\"' class='pointers'>
                <td class='fontSize10px'>" . self::changeTimeZone($team->fixture->timezone, $team->fixture->date) . "</td>
                <td class='fontSize10px'>" . $team->teams->home->name . "</td>
                <td class='fontSize10px'>vs</td>
                <td class='fontSize10px'>" . $team->teams->away->name . "</td>
                <td class='fontSize10px'>" . self::callPrediction($team) . "</td>
                <td class='fontSize10px'>" . self::odd($team->fixture->id) . "</td>
                <td class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;'  target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' target='_blank'  style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;'> Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
            }
        }
    }
    public static function predictions($fixtureId, $type, $typeTwo)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/predictions?fixture=" . $fixtureId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: b1e1fe16-42e9-60b7-0f06-69d5f0a075b0",
                "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                "x-rapidapi-key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650"
            ),
        ));

        $response = curl_exec($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response[0])) {
            $responses = "no predictions";
        } else {
            $responses = json_decode($response)->response[0]->predictions->$type->$typeTwo;
        }

        return $responses;
    }
    public static function callPrediction($team)
    {
        if ($team->teams->home->name == self::predictions($team->fixture->id, "winner", "name")) {
            return "1x";
        } else {
            return "x2";
        }
    }


    public static function loadFixtureData($fixtureId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?id=$fixtureId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response[0])) {
            echo "<p class=' errorMsgBg p-3 white boldSix mt-4 wid80 centerText d-block mx-auto' role='alert'>No Games Available Today</p>";
        } else {
            $team = json_decode($response)->response[0];
            echo "<p class='white fontSize12px boldFive wid100 bgShaddyWhite p-2'><img src='" . $team->league->flag  . "' class='me-2 wid16px' alt=''> " . $team->league->country . " | " . $team->league->country . "</p>
            <div class='wid100 p-2'>
            <div class='d-block bgSocials wid100 mx-auto mt-5'>
                <div class='d-block wid100Mobile wid75 mx-auto'>
                    <div class='d-flex p-2 justify-content-between align-items-center'>
                        <div class='d-flex align-items-center'><!-- width will help with the flex spacing -->
                            <span class='fontSize20px socialColorDeeper boldFive centerText'>" . $team->teams->home->name . " </span>
                            <div class='d-lg-flex align-items-center ms-2 d-none'>
                              " . self::showStandingsCal($team->teams->home->id) . "
                            </div>
                        </div>
                        <span class='boldFour bodyA mx-4 fontSize12px'>" . self::changeTimeZoneFixture($team->fixture->timezone, $team->fixture->date) . "</span>
                        <div class='d-flex align-items-center'>
                            <div class='d-lg-flex align-items-center me-3  d-none'>
                            " . self::showStandingsCal($team->teams->away->id) . "
                            </div>
                            <span class='fontSize20px socialColorDeeper boldFive'>" . $team->teams->away->name . "</span>
                        </div>
                    </div>
                </div>
            </div>
            " . self::predictionsTwo($team->fixture->id) . "
        ";
        }
    }

    public static function predictionsTwo($fixtureId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/predictions?fixture=" . $fixtureId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: b1e1fe16-42e9-60b7-0f06-69d5f0a075b0",
                "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                "x-rapidapi-key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650"
            ),
        ));

        $response = curl_exec($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response[0])) {
            return "no predictions";
        } else {
            $responses = json_decode($response)->response[0]->predictions;
            $secondResp = json_decode($response)->response[0];
            return "
            <div class='row justify-content-center m-5'>
            <span class='fontSize12px p-1 bgSocials col-md-6 socialColorDeeper ms-3 boldFive'>Prediction</span>
            <span class='fontSize12px col-md-6 p-2 bortop socialColorDeeper ms-3 boldFour'><span class='d-inline-block me-2' style='color: #4d4d4d;'>WINNER:</span>" . $responses->winner->name . "</span>
            <span class='fontSize12px col-md-6  p-2 bortop socialColorDeeper ms-3 boldFour'>
            <!-- <span class='d-inline-block me-2' style='color: #4d4d4d;'>Over+/Under-:</span>" . $responses->under_over . "</span> -->
            <span class='fontSize12px col-md-6 p-2 bortop socialColorDeeper ms-1 boldFour'>" . $responses->advice . "</span>
            </div>
            <p class='fontSize12px noWrap boldFive p-2 bgSocials socialColorDeeper'>Head to Head</p>
            " . self::H2H(json_decode($response)->response[0]->h2h) . "
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
            <div class='wid45 wid100Mobile'>
                <span class='fontSize12px d-block boldFive p-2 bgSocials socialColorDeeper'>" . $secondResp->teams->home->name . ": Last results</span>
                " . self::lastGamesHome($secondResp->teams->home->id) . "
            </div>
            <div class='wid45 wid100Mobile'>
            <span class='fontSize12px d-block boldFive p-2 bgSocials socialColorDeeper'>" . $secondResp->teams->away->name . ": Last results</span>
            " . self::lastGamesAway($secondResp->teams->away->id) . "
            </div>
           </div>
        </div>
            ";
        }
    }

    public static function H2H($datas)
    {
        $resp = "";
        foreach ($datas as &$data) {
            $resp .= "
            <div class='d-block wid100 rounded-pill p-2 m-1 shadow-sm'>
                <div class='ms-3 ms-sm-5 d-flex justify-content-between align-items-center wid40 wid30Mobile'>
                    <span class='fontSize10px noWrap bodyA boldFour'>" . self::changeTimeZoneTwo($data->fixture->timezone, $data->fixture->date) . " </span>
                    <span class='fontSize12px socialColorDeeper noWrap boldFour'>" . $data->teams->home->name . "</span>
                    <span class='fontSize14px socialColorDeeper noWrap boldFive'> " . $data->goals->home . " : " . $data->goals->away . "</span>
                    <span class='fontSize12px noWrap socialColorDeeper boldFour'> " . $data->teams->away->name . "</span>
                </div>
            </div>
           ";
        }
        return $resp;
    }
    public static function lastGamesHome($teamId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?team=$teamId&last=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);
        $load = "";
        if (!isset(json_decode($response)->response[0])) {
            $load .=  "no data";
        } else {
            $responses = json_decode($response)->response;
            foreach ($responses as $response) {
                // if ($response->teams->home->winner == null) {
                //     $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGrey'>D</span>";
                // } else if ($response->teams->home->winner) {
                //     $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen'>W</span>";
                // } else {
                //     $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingRed'>L</span>";
                // }
                switch ($response->teams->home->winner) {
                    case null:
                        if (isset($response->teams->home->winner)) {
                            if ($response->teams->home->id == $teamId) {
                                $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingRed'>L</span>";
                            } else {
                                $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen'>W</span>";
                            }
                        } else {
                            $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGrey'>D</span>";
                        }
                        break;
                    case true:
                        if ($response->teams->home->winner && $response->teams->home->id == $teamId) {
                            $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen'>W</span>";
                        } else {
                            $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingRed'>L</span>";
                        }

                        break;
                    case false:
                        $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive bgSocials'>L</span>";

                        break;
                        // case false:
                        //     $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingRed'>L</span>";
                        //     break;
                    default:
                        # code...
                        break;
                }
                $load .= "
                <div class='d-flex my-1 justify-content-between p-2 align-items-center shadow-sm'>
                <div class='d-flex align-items-center'>
                    $winner
                    <span class='blackKsbTwo fontSize10px noWrap'>" . $response->teams->home->name . " N " . $response->teams->away->name . "</span>
                </div>
                <span class='fontSize10px blackKsbTwo'>" . $response->goals->home . ":" . $response->goals->away . "</span>
            </div>
                ";
            }
        }
        return $load;
    }

    public static function lastGamesAway($teamId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?team=$teamId&last=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);
        $load = "";
        if (!isset(json_decode($response)->response[0])) {
            $load .=  "no data";
        } else {
            $responses = json_decode($response)->response;
            foreach ($responses as $response) {
                // if ($response->teams->home->winner == null) {
                //     $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGrey'>D</span>";
                // } else if ($response->teams->home->winner) {
                //     $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen'>W</span>";
                // } else {
                //     $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingRed'>L</span>";
                // }
                switch ($response->teams->away->winner) {
                    case null:
                        if (isset($response->teams->away->winner)) {
                            if ($response->teams->away->id == $teamId) {
                                $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingRed'>L</span>";
                            } else {
                                $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen'>W</span>";
                            }
                        } else {
                            $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGrey'>D</span>";
                        }
                        break;
                    case true:
                        if ($response->teams->away->winner && $response->teams->away->id == $teamId) {
                            $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingGreen'>W</span>";
                        } else {
                            $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive standingRed'>L</span>";
                        }

                        break;
                    case false:
                        $winner = "<span class='fontSize12px me-3 padSmall1 borderRA1 white boldFive bgSocials'>L</span>";

                        break;
                    default:
                        # code...
                        break;
                }
                $load .= "
                <div class='d-flex my-1 justify-content-between p-2 align-items-center shadow-sm'>
                <div class='d-flex align-items-center'>
                    $winner
                    <span class='blackKsbTwo fontSize10px noWrap'>" . $response->teams->home->name . " N " . $response->teams->away->name . "</span>
                </div>
                <span class='fontSize10px blackKsbTwo'>" . $response->goals->home . ":" . $response->goals->away . "</span>
            </div>
                ";
            }
        }
        return $load;
    }
    public static function showStandings($teamId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/standings?team=" . $teamId . "&season=2022",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: b1e1fe16-42e9-60b7-0f06-69d5f0a075b0",
                "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                "x-rapidapi-key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650"
            ),
        ));

        $response = curl_exec($curl);
        $responses = "";
        $err = curl_error($curl);

        curl_close($curl);

        if (!isset(json_decode($response)->response[0]->league->standings[0][0]->form)) {
            $responses = "";
        } else {
            $responses = str_split(json_decode($response)->response[0]->league->standings[0][0]->form);
        }

        return $responses;
    }

    public static function showStandingsCal($team)
    {
        $responseHtml = "";
        $stand = self::showStandings($team);
        if (is_array($stand)) {
            foreach ($stand as $sta) {
                if ($sta == "D") {
                    $responseHtml .= "<span class='fontSize6px marginRightStandings padSmall7 borderRA1 white boldFive standingGrey'>D</span>";
                } else if ($sta == "L") {
                    $responseHtml .=  "<span class='fontSize6px marginRightStandings padSmall7 borderRA1 white boldFive standingRed'>L</span>
                    ";
                } else {
                    $responseHtml .= "<span class='fontSize6px marginRightStandings padSmall7 borderRA1 white boldFive standingGreen'>W</span>";
                }
            }
        } else {
            $responseHtml .= "no standings";
        }
        return $responseHtml;
    }

    public static function countries()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-football-v1.p.rapidapi.com/v3/countries',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
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
?>
                <a href="<?php echo $country->code ?>" class="wid100 country bodyA d-block boldFive p-2 marginY fontSize12px bgWhite" onclick="event.preventDefault();  
                $.ajax({
                    url: 'loadLeagues/<?php echo strval($country->code) ?>',
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


    public static function leagues($countryCode)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/leagues?code=$countryCode",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Key: de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650',
                'X-RapidAPI-Host: api-football-v1.p.rapidapi.com'
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
                <a href='/league/" . $league->league->id . "' class='wid100 league bodyA d-block boldFive p-2 m-2 shadow-sm fontSize12px bgWhite' onclick='event.preventDefault(); loadGames(" . $league->league->id . ");' id='ahref-link-" . $league->league->type . "' ><img src='" . $league->league->logo . "'class='wid16px'  alt=''> " . $league->league->name . "</a>
                ";
            }
            echo $gameUI;
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
