<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function parser(request $request){
        if($request->hasFile('filename')) {
            $file = $request->file('filename');
        }
        $openFile = file($file);
        $words = [];
        $traffic = 0;
        $bots=[];
        foreach ($openFile as $string) {
            $bot = stripos($string, 'bot');
            if ($bot){
                $bots[]= $string;
            }
            $words[] = explode(" ",$string);
        }
        foreach ($words as $word){
            // подсчет траффика для POST запросов
            if($word[5]=='"POST'){
                if($traffic==0){
                    $traffic = $word[9];
                } else {
                    $traffic = $traffic + $word[9];
                }
            }
        }
        $views = count($openFile);
        $url = array_count_values(array_column($words, 6));
        $statusCode = array_count_values(array_column($words, 8));

        $result = [];
        $result['views'] = $views;
        $result['urls'] = count($url);
        $result['traffic'] = $traffic;
        $result['statusCode'] = $statusCode;
        $result['countBots'] = count($bots);

        return response()->json($result,200);
    }
}
