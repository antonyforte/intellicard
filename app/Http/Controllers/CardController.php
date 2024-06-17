<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DeckController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GroqController;


use App\Models\Card;

class CardController extends Controller
{

    public function create(Request $request) {

        $cardsJson = $request->input('cards');
        $cards = json_decode($cardsJson, true);

        foreach($cards as $card) {
            $newcard = new Card;
            $newcard->front = $card['front'];
            $newcard->back = $card['back'];
            $newcard->user_id = Auth::user()->id;
            if ($card['deck_id'] == ''){
                $newcard->deck_id = null;
            } else {
                $newcard->deck_id = $card['deck_id'];

            }

            if ($card['category_id'] == ''){
                $newcard->category_id = null;
            } else {
                $newcard->category_id = $card['category_id'];

            }

            $newcard->save();
        }

        return redirect()->route('list');


    }
    public function list() {
        $user =  Auth::user()->id;

        $cards = Card::where('user_id', $user)->get();

        return $cards;
    }

    public function update(Request $request, $id) {
        $newcard = Card::findOrFail($id);
        $cards = $request->input('cards');
        $cardData = json_decode($cards, true);
    
        // Assuming $cardData is an array, we loop through each card data
        foreach ($cardData as $card) {
            $newcard->front = $card['front'];
            $newcard->back = $card['back'];
            $newcard->user_id = Auth::user()->id;
            
            if ($card['deck_id'] === '') {
                $newcard->deck_id = null;
            } else {
                $newcard->deck_id = $card['deck_id'];
            }
    
            if ($card['category_id'] === '') {
                $newcard->category_id = null;
            } else {
                $newcard->category_id = $card['category_id'];
            }
    
            $newcard->save();
        }
    
        return redirect()->route('dashboard');
    }
    

    public function delete($card_id) {
        $card = Card::findOrFail($card_id);
        $card->delete();
        return redirect()->route('dashboard');

    }

    public function rud($card_id) {
        
        $deckController = app()->make(DeckController::class);
        $categoryController = app()->make(CategoryController::class);
        $decks = $deckController->list();
        $categories = $categoryController->list2();
        
        $card = Card::findOrFail($card_id);
        

        return view('card-rud', [
            'decks' => $decks,
            'categories' => $categories,
            'card' => $card
        ]);
    }

    public function removeCard($deck_id, $card_id) {
        $card = Card::findOrFail($card_id);
        $card->deck_id = null;
        $card->save();
        return redirect()->route('deck.rud',$deck_id);
    }

    public function cardGeneration() {

        $deckController = app()->make(DeckController::class);
        $categoryController = app()->make(CategoryController::class);
        $decks = $deckController->list();
        $categories = $categoryController->list2();

        $cards = [];
        return view('card-creation', [
            'decks' => $decks,
            'categories' => $categories,
            'cards' => $cards,
        ]);
    }


    public function cardGenerationAI(Request $request) {

        $cards = [];
        $iaresponse = $request->input('response');


        $deckController = app()->make(DeckController::class);
        $categoryController = app()->make(CategoryController::class);
        $groqController = app()->make(GroqController::class);

        $decks = $deckController->list();
        $categories = $categoryController->list2();

        $aiCardsList = $groqController->responseCompilation($iaresponse);

        $fronts = $aiCardsList['fronts'];
        $backs = $aiCardsList['backs'];

        foreach ($fronts as $index => $front){
            $back = $backs[$index];

            $cards[$index] = new Card();

            $cards[$index]->front = $front;
            $cards[$index]->back = $back; 
        }


        return view('card-creation', [
            'decks' => $decks,
            'categories' => $categories,
            'cards' => $cards,
        ]);
    }
    public function aiCardGeneration() {
        return view('ia-card-creation');
    }

    public function aiSimulate() {
        $cards = [
            ['Front' => 'Question 1', 'Back' => 'Answer 1'],
            ['Front' => 'Question 2', 'Back' => 'Answer 2'],
            ['Front' => 'Question 3', 'Back' => 'Answer 3'],
            ['Front' => 'Question 4', 'Back' => 'Answer 4'],
            ['Front' => 'Question 5', 'Back' => 'Answer 5'],
            ['Front' => 'Question 6', 'Back' => 'Answer 6'],
        ];
        
        return $cards;
    }
}
