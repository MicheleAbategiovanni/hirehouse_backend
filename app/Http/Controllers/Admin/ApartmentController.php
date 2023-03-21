<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditApartmentRequest;
use App\Http\Requests\StoreApartmentRequest;
use App\Models\Rule;
use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rules = Rule::all();
        $services = Service::all();

        return view("admin.apartments.create", compact('rules', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {

        $data = $request->validated();
        $data = $request->all();

        //   modifichiamo la stringa usando una funzione precompilata che sostituisce gli spazi vuoti con + 
        $data["full_address"] = urlencode($data["full_address"]);
        //otteniamo le informazioni usando la funzione get content che utilizza le api di tomtom 
        $tomtomData = file_get_contents("https://api.tomtom.com/search/2/geocode/" . $data['full_address'] . ".json?key=6hakT8QU7IRSx9PCHGi5JyHTV2S7xWlD");
        //dal risultato della funzione get content trasforma la stringa in un array associativo
        $tomtomData = json_decode($tomtomData, JSON_PRETTY_PRINT);




        if (key_exists("cover_img", $data)) {
            $path = Storage::put("apartment_images", $data["cover_img"]);
        }

        //IMPORTANTE ABBIAMO DECISO DI USARE IL PRIMO RISULTATO DELLA LISTA E TRALASCIATO GLI ALTRI
        //aggiorniamo il valore di full_address con il risultato ottenuto dalla chiamata al sito tomtom
        $data["full_address"] = $tomtomData["results"][0]["address"]["freeformAddress"];
        $newApartment = Apartment::create([
            ...$data,
            'user_id' => Auth::user()->id,
            'cover_img' => $path ?? "apartment_images/house_default.png",
            //assegniamo lat e lon dall'array associativo ottenuto precedentemente accedendo ai vari campi
            "latitude" => $tomtomData["results"][0]["position"]["lat"],
            "longitude" => $tomtomData["results"][0]["position"]["lon"],
        ]);


        if ($request->has('rules')) {
            $newApartment->rules()->attach($data['rules']);
        }

        if ($request->has('services')) {
            $newApartment->services()->attach($data['services']);
        }


        return redirect()->route("admin.apartments.show", $newApartment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        
        return view("admin.apartments.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)

    {
        //controlliamo che l'utente loggato abbia la possibilita di modificare l'appartamento facendo un check con l'id
        if ($apartment->user_id !== Auth::id()) {
            abort(403, "Non sei autorizzato a modificare questo appartamento");
        };

        $apartment->load("rules", "services");
        $rules = Rule::all();
        $services = Service::all();

        return view("admin.apartments.edit", compact("apartment", "rules", "services"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditApartmentRequest $request, Apartment $apartment)
    {

        $data = $request->validated();
        $data = $request->all();


        //   modifichiamo la stringa usando una funzione precompilata che sostituisce gli spazi vuoti con + 
        $data["full_address"] = urlencode($data["full_address"]);
        //otteniamo le informazioni usando la funzione get content che utilizza le api di tomtom 
        $tomtomData = file_get_contents("https://api.tomtom.com/search/2/geocode/" . $data['full_address'] . ".json?key=6hakT8QU7IRSx9PCHGi5JyHTV2S7xWlD");
        //dal risultato della funzione get content trasforma la stringa in un array associativo
        $tomtomData = json_decode($tomtomData, JSON_PRETTY_PRINT);

        //IMPORTANTE ABBIAMO DECISO DI USARE IL PRIMO RISULTATO DELLA LISTA E TRALASCIATO GLI ALTRI
        //aggiorniamo il valore di full_address con il risultato ottenuto dalla chiamata al sito tomtom
        $data["full_address"] = $tomtomData["results"][0]["address"]["freeformAddress"];

        if (key_exists("rules", $data)) {
            $apartment->rules()->sync($data['rules']);
        } else {
            $apartment->rules()->sync([]);
        }
        if (key_exists("services", $data)) {

            $apartment->services()->sync($data['services']);
        } else {
            $apartment->services()->sync([]);
        }
        if (key_exists("cover_img", $data)) {
            $path = Storage::put("apartment_images", $data["cover_img"]);
            if (!$apartment->cover_img === "apartment_images/house_default.png") {
                Storage::delete($apartment->cover_img);
            }
        }

        $apartment->fill([
            ...$data,
            'user_id' => Auth::user()->id,
            //assegniamo lat e lon dall'array associativo ottenuto precedentemente accedendo ai vari campi
            "latitude" => $tomtomData["results"][0]["position"]["lat"],
            "longitude" => $tomtomData["results"][0]["position"]["lon"],

        ]);
        if (key_exists("cover_img", $data)) {
            $apartment->cover_img = $path;
        }
        $apartment->save();
        return redirect()->route("admin.apartments.show", $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if (!$apartment->cover_img === "apartment_images/house_default.png") {
            Storage::delete($apartment->cover_img);
        }
        
        $apartment->load("sponsors");
        $apartment->rules()->detach();
        $apartment->services()->detach();
       $apartment->allSponsors()->detach();
        $apartment->messages()->delete();
        
        
       
        $apartment->delete();

        return redirect()->route("admin.dashboard");
    }

    // public function addSponsor(Apartment $apartment, Sponsor $sponsor)
    // {
    //     // data di inzio
    //     $currentDateTime = Carbon::now();
    //     // data di fine, calcolata in base alla sponsorizzazione selezionata 
    //     $newDateTime = Carbon::now()->addHour($sponsor->hours);
    //     // creazione del record all'interno della tabella ponte 
    //     $apartment->sponsors()->attach($sponsor->id, ["start_date" => $currentDateTime, "end_date" => $newDateTime]);

    //     return redirect()->route("admin.apartments.show", $apartment->id);
    // }
}
