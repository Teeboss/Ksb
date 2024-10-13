<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class tennisController extends Controller
{
    function loadGames()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.toptennistips.com/data-v3/predictions/?filtered=true&user=S67e5wzTsWAQcr39dPqGk8I896PTl9vWjkbaam4yQXGImJ9mHEZ9pirDtKe3v9nsdJ2r78B42f9Nn3kE3mSSjau35yAiua7K9jeDmqawdPWQS1aQCd4Tqcq0goaBzYpCE1_tUFnweo2agKmBTh0wSQ==',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (json_decode($response) == []) {
            echo "   
            <tr>
            <td colspan='8'>
            <p class=' errorMsgBg p-3 white boldSix mt-4 wid100 centerText d-block mx-auto' role='alert'>No Games Available Today</p>
            </td>
            </tr>";
        }
        foreach (json_decode($response) as $game) {
            echo "                           
                <tr>
                <td class='fontSize10px'>" . date('m-d H:m', $game->date) . "</td>
                <td class='fontSize10px'>" . $game->player1 . "</td>
                <td class='fontSize10px'>vs</td>
                <td class='fontSize10px'>" . $game->player2 . "</td>
                <td class='fontSize10px'>$game->tournament</td>
                <td class='fontSize10px'>" . $game->selection . "(" . $game->market->handicap . ")</td>
                <td class='fontSize10px'>" . $game->selectionOdds . "</td>
                <td colspan='2' class='fontSize10px'>
                <div class=' wid70 wid100Mobile mx-auto'>
                <div class='d-flex align-items-center justify-content-between'>
                    <div class='btn-group' style='border: solid #0f46dc 1px; border-radius: 25px; overflow: hidden;'>
                    <a href='https://clcr.me/xsOTPT' class='btn' sytle='padding: 3px;' target='_blank' ><img src='" . asset('icons/1xbet.png') . "' alt='' class='iconSmall'></a>
                    <a href='https://clcr.me/xsOTPT' class='' target='_blank' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;'> Bet Now</a>
                    </div>
                 <!--   <a href='https://paripesa.bet/solomonbet'><img src='" . asset('icons/paripasa.png') . "' alt=''></a>
                    <a href='http://bit.ly/ZB-KingBets'><img src='" . asset('icons/zebet.png') . "' alt=''></a> -->
                </div>
                </td>
            </tr>";
        }
    }
}
