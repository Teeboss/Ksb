<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\footballController;
use App\Models\todayGames;

class loadTodayGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:loadTodayGames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v3/fixtures?next=30",
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

        $objects = array();
        $fixtureId = "";
        $leagueId = "";

        foreach ($responses->response as $team) {

        // $objects[] = array($team->fixture->id, $team->league->id);
         $leagueId = $team->league->id;
         $fixtureId = $team->fixture->id;

         $objects[] = "<div class='modal fade' id='staticBackdrop" . $team->fixture->id . "' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-body'>
                    <iframe src='/fixture/".$team->fixture->id . "/" . $team->league->id."' frameborder='0' style='width: 100%; height: 400px; border: none;'></iframe>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    </div>
                    </div>
                </div>
                </div>

                <tr class='pointers' data-bs-toggle='modal' data-bs-target='#staticBackdrop" . $team->fixture->id . "'>
                    <td colspan='4' class='boldFour fontSize10px' ><img src='" . $team->league->flag  . "' alt='' class='wid8px'> " . $team->league->country . " | " . footballController::changeTimeZone($team->fixture->timezone, $team->fixture->date) . " <br> <span class='boldFive fontSize12px'>" . $team->teams->home->name . " vs " . $team->teams->away->name . "</span>
                    </td>
                    <td class='boldFive fontSize14px'>" . footballController::callPrediction($team) . "</td>
                    <td colspan='2' class='boldFive fontSize12px'>" . footballController::odd($team->fixture->id) . "</td>
                    <td>
                    <div class=' wid70 wid100Mobile mx-auto'>
                        <div class='d-flex align-items-center justify-content-between'>
                            <div class='d-flex justify-content-center glow'>
                                <a href='https://stake.com/?c=KGSB' class='' style='color: white; background-color:red; font-size: 10px; font-weight: 700; white-space: nowrap; text-decoration: none; padding: 5px;'> Bet Now</a>
                            </div>
                        </div>
                    </td>
                </tr>
               ";
        }  
         $result = implode('^^', $objects); 

       todayGames::create([
            'games' => $result,
            'fixture_id' => $fixtureId,
            'league_id' => $leagueId,
            'odd' => '',
            'oddTwo' => ' ',
            'vendor' => '',
            'vendorTwo' => '',
            'header' => '',
            'url' => '',
            'urlTwo' => '',
            'booking' => '',
            'bookingTwo' => '',
            'status' => 0,
        ]);

        $this->info('Data inserted successfully!');
    }
}
