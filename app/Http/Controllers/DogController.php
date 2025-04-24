<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\Http; 
use App\Models\Cache;
use Carbon\Carbon;

class DogController extends Controller
{
    /**
     * Display a full list of pets fetched from the API.
     * 
     * @param ,
     * @return view
     */
    public function list()
    {
        $errMsg = '';
        $breedItems = '';

        $yesterday = Carbon::yesterday()->timestamp;

        $cache = Cache::where('key','list')->where('expiration', '>', $yesterday)->get(); 
        if($cache->count() === 0)
        {
            $response = Http::withHeaders([
                'x-api-key' => env('API_DOG'),
            ])->get('https://dog.ceo/api/breeds/list/all');

                
            if($response->successful()) 
            {
                $breedItems = $response->json()['message']; 
                
            }else{
                $errMsg = 'Dog API error.';
            }
            $existCache = Cache::where('key','list')->first(); //couldn't use updateOrCreate because table has no ID
            if(!$existCache)
            {
                $Cache = new Cache();
                $Cache->key = 'list';
                $Cache->value = $response;
                $Cache->expiration = time();
                $Cache->save();
            }else
            {
                $existCache->where('key','list')->update(['value' => $response, 'expiration' => time()]);
            }
            
        }else
        {
            $cacheResult = Cache::select('value')->where('key','list')->first();
            $breedArr = json_decode($cacheResult['value'], true);
            if(is_array($breedArr) && !empty($breedArr))
            {
                $breedItems = $breedArr['message'];
            }else
            {
                $errMsg = 'Dog API error.';
            }

        }
       

        

        return view('dashboard',  compact('breedItems', 'errMsg'));
    }

    /**
     * Detailed page
     *
     * @param string
     * @return view 
     */
    public function breedDetail($name = '')
    {
        $response = Http::withHeaders([
            'x-api-key' => env('API_DOG'),
        ])->get("https://dog.ceo/api/breed/{$name}/images/random/4");

        $errMsg = '';
        $breedItems = '';

        if($response->successful()) 
        {
            $breedItems = $response->json()['message']; 
            
        }else{
            $errMsg = 'Dog API error.';
        }
        return view('dog.detail', compact('breedItems', 'errMsg')); 
    }
}
