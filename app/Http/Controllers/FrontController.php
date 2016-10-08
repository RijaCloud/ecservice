<?php

namespace App\Http\Controllers;

use App\Repository\LieuRepository;
use App\Repository\TerritoryRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\Facades\Image;

class FrontController extends Controller
{

    protected $lieux ;

    protected $repository;

    public function __construct(LieuRepository $lieux, TerritoryRepository $repository)
    {
        $this->lieux = $lieux;
        $this->repository = $repository;
    }

    public function index(TerritoryRepository $territory) {
        
        $fokontany = $territory->allFokontany();
        
        return view('partial.index',compact('fokontany'));
        
    }

    /**
     * @param null $name
     * @param Request $request
     * @return mixed
     */
    public function fokontany(Request $request,$name = null) {

        if(!is_null($name)) {

            $search = $this->repository->oneFokontany($name);
            $thatPlace = [];
            if(!$search)
                return view('partial.services',compact('thatPlace'));

            $specified_query = [];

            if($request->has('sv')) {
                
                array_push($specified_query,strtolower($request->get('sv')));
                
            } else {

                if($request->has('sv-h'))
                    array_push($specified_query,'huiles');
                if($request->has('sv-acces'))
                    array_push($specified_query,'accessoires');
                if($request->has('sv-g'))
                    array_push($specified_query,'garage');
                if($request->has('sv-p'))
                    array_push($specified_query,'pieces');
                if($request->has('sv-m'))
                    array_push($specified_query,'vente_moto');

            }
            
            $thatPlace = $this->lieux->allWhereFokontany($search->id,$specified_query);

            $thatPlace = array_merge_recursive(['place'=>$thatPlace] , ['center'=>[
                'lat' => $search->latitude,
                'lng' => $search->longitude
            ]]);
        
            return view('partial.services',compact('thatPlace'));

        } else {

            $thatPlace = ['place'=>$this->lieux->allPlaceWithNoConstraint()->get()];
            
            $link = $this->lieux->allPlaceWithNoConstraint()->paginate()->render();

            return view('partial.services',compact('thatPlace','link'));

        }

    }

}
