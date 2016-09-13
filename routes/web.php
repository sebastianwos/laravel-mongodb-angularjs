<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('imports', function(){

    $allLines = [];

    $client = new Goutte\Client();
    $crawler = $client->request("GET", 'http://www.infores.pl/mpk/rozklad/');
    $crawler->filter('.LinieBody > a')->each(function($node) use(&$allLines){
        $lineId = str_replace(["'", "(", ")", "wyspietl_przystanek_infores_mpk"], '', $node->attr('onclick'));
        $allLines[] = $lineId;
    });


    $lines = [];

    foreach($allLines as $key => $line){
        $client = new Goutte\Client();
        $crawler = $client->request("POST", 'http://www.infores.pl/mpk/baseCode.php', ['index' => $line]);
        $crawler->filter('#przystanek_nazwa')->each(function($node, $i) use (&$lines, $key){
            $lines[$key][$i]['name'] = $node->text();
        });
        $crawler->filter('#next_przystanki .next_list')->each(function($node, $i) use(&$lines, $key) {
            $node->filter('a')->each(function($stop, $j) use (&$lines, $i, $key){
                $lines[$key][$i]['stops'][$j] = str_replace(["'", "(", ")", "wyspietl_nowa_tabliczke_infores_mpk"], '', $stop->attr('onclick'));
            });
        });
    }

    $key = 0;
    $linesStops = [];
    foreach ($lines as $doublelines)
    {
        foreach($doublelines as $line)
        {
            $key++;
            $lineName = $line['name'];
            $linesStops[$key]['line_name'] = $lineName;

            foreach ($line['stops'] as $skey => $stop)
            {
                $daysKey = null;
                $crawler = $client->request("POST", 'http://www.infores.pl/mpk/baseCode.php', ['index' => $stop]);
                $stopTitle = $crawler->filter('#przystanek_title span')->first()->text();
                $linesStops[$key]['stop'][$skey]['name'] = $stopTitle;
                $table = $crawler->filter('#tabliczka_rozklad table')->first()->filter('tr')->each(function($node) use($key, $skey, $lineName, &$linesStops, &$daysKey) {
                    $th = str_slug($node->children()->first()->text());
                    if($th){
                        $daysKey = $th;
                    }
                    $node->children()->each(function($node, $i) use($key, $skey, $lineName, &$linesStops, $daysKey) {
                        if($node->nodeName() == 'th' && $node->attr('class') != 'subject'){
                            $linesStops[$key]['stop'][$skey]['table'][$daysKey][$node->text()] = '';
                        }elseif($node->nodeName() == 'td' && $node->attr('class') != 'separator'){
                            $index = $i == 23 ? 0 : $i + 1;
                            $times = explode('<br>', $node->html());
                            $linesStops[$key]['stop'][$skey]['table'][$daysKey][$index] = array_filter($times) ? $times : [];
                        }
                    });
                });
            }
        }
    }

    foreach($linesStops as $linestop){
        $line = App\Line::create(['name' => $linestop['line_name']]);
        foreach($linestop['stop'] as $stop){
            $busStop = App\BusStop::where('name', $stop['name'])->first();
            if($busStop === null){
                $busStop = App\BusStop::create(['name' => $stop['name']]);
            }
            $line->busStops()->attach($busStop);
            $table = new App\Table;
            $table->attach($line, $busStop);
            $table->data = $stop['table'];
            $table->save();
        }
    }

});
