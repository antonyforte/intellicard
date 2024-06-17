<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Deck;

use App\Models\Card;
use App\Models\Category;

class DeckController extends Controller
{
    public function create(Request $request) {
        $deck = new Deck;

        $deck->name = $request->name;
        $deck->user_id = Auth::user()->id;        
        $deck->save();


        return redirect()->route('list');
    }

    public function list() {
        $user =  Auth::user()->id;

        $decks = Deck::where('user_id', $user)->get();

        return $decks;
    }

    public function update(Request $request, $id) {
        
        $deck = Deck::findOrFail($id);

        $deck->name = $request->name;

        $deck->save();
    
        return redirect()->back();
    }
    

    public function delete($deck_id) {
        $deck = Deck::findOrFail($deck_id);
        $deck->delete();
        return redirect()->route('list');

    }

    public function rud($deck_id) {
        $deck = Deck::findOrFail($deck_id);
    
        $deckController = app()->make(DeckController::class);
        $categoryController = app()->make(CategoryController::class);
        
        $cards = Card::where('deck_id', $deck->id)->get();
        $categories = [];
        
        foreach($cards as $index => $card) {
            // Retrieve the first matching category instead of a collection
            $categorie = Category::where('id', $card->category_id)->first(); // Assuming there's a category_id field in the cards table
            $categories[$index] = $categorie;
    

        }
    
        return view('deck-rud', [
            'deck' => $deck,
            'categories' => $categories,
            'cards' => $cards
        ]);
    }
    
}
