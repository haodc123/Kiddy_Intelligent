<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameCats;
use App\GameCatT;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request) {

        $g = new Game();
        $gc = new GameCats();
        $gt = new GameCatT();
        $g_new = $g->getNewGames(24);
        $g_hot = $g->getHotnSpecialGame(48); // 8 Special

        $gt_all = $gt->getArrayCatTRichInfo();
        $gc_by_id = $gt_all[0];
        $arr_tags = $gt->getAllCatT();

        $gbc_u4 = $g->getGamesByCatYO(66, 18); // Under 4
        $gbc_a4 = $g->getGamesByCatYO(67, 18); // Above 4

        // print_r($gc_by_id);
        return view('home.home', [
            'g_new' => $g_new,
            'g_hot' => $g_hot,
            'gbc_u4' => $gbc_u4,
            'gbc_a4' => $gbc_a4,
            'gc_by_id' => $gc_by_id,
            'arr_tags' => $arr_tags
        ]);
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }
}
