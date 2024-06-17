<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntitiesController extends Controller
{   
    public function dashboardlist()
    {
        $cardController = new CardController();
        $deckController = new DeckController();
        $categorieController = new CategoryController();

        $cards = $cardController->list();
        $decks = $deckController->list();
        $categories = $categorieController->list();

        return view('dashboard', [
            'cards' => $cards,
            'decks' => $decks,
            'categories' => $categories,
        ]);
    }
    public function list()
    {
        $cardController = new CardController();
        $deckController = new DeckController();

        $cards = $cardController->list();
        $decks = $deckController->list();

        return view('list', [
            'cards' => $cards,
            'decks' => $decks,
        ]);
    }
}
