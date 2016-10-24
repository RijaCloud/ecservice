<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Fokontany;
use App\Models\Region;
use App\Repository\LieuRepository;
use App\Repository\TerritoryRepository;
use Illuminate\Http\Request;
use App\Http\Requests;

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

        } else {

            $search = null;

        }

        return $this->loadResult($search,$request,'fokontany',100);

    }


    /**
     * @param null $name
     * @param Request $request
     * @return mixed
     */
    public function commune(Request $request,$name = null) {

        if(!is_null($name)) {

            $search = $this->repository->oneCommune($name);

        } else {

            $search = $this->repository->oneCommune("1er Arrondissement");

        }

        return $this->loadResult($search,$request,'commune',100);

    }

    /**
     * @param null $name
     * @param Request $request
     * @return mixed
     */
    public function region(Request $request,$name = null) {

        if(!is_null($name)) {

            $search = $this->repository->oneRegion($name);

        } else {

            $search = $this->repository->oneRegion("Analamanga");

        }

        return $this->loadResult($search,$request,'region',100);

    }


    /**
     * @param null $name
     * @param Request $request
     * @return mixed
     */
    public function district(Request $request,$name = null) {

        if(!is_null($name)) {
            $search = $this->repository->oneDistrict($name);

        } else {
            $search = $this->repository->oneDistrict("Analamanga");

        }

        return $this->loadResult($search,$request,'district',100);

    }

    public function match(Request $request) {
        
        if($request->has('s') && $request->has('sp')) {
            
            $match = $request->get('s');
            $sp = $request->get('sp');
            $instance = null;

            switch($sp) {

                case 'region':
                    $instance = new Region();
                    break;

                case 'district':
                    $instance = new District();
                    break;

                case 'fokontany':
                    $instance = new Fokontany();
                    break;

                case 'commune':
                    $instance = new Fokontany();
                    break;

            }

            return $instance->filter($match);
            
        }
         
    }


    public function search(Request $request) {

        if($request->has('s')) {

            $match = $request->get('s');

            $instance = new Fokontany();

            return $instance->filter($match);

        }

    }

    public function localizeMe(Request $request) {

        $thatPlace = [];

        if($request->has('lat') && $request->has('lng')) {

            $thatPlace = $this->lieux->allWhere($request->only('lat','lng'),[],.3);

            $thatPlace = array_merge_recursive(['place'=>$thatPlace] , ['center'=>[
                'lat' => $request->get('lat'),
                'lng' => $request->get('lng')
            ]]);

            return view('partial.services',compact('thatPlace'));

        } else {

            return view('partial.services',['place'=>$thatPlace]);

        }

    }

    public function loadResult($search,$request,$locality,$d) {

        $thatPlace = [];

        $specified_query = [];

        if($request->has('sv')) {

            array_push($specified_query,strtolower($request->get('sv')));

        } else {

            if($request->has('sv-h'))
                array_push($specified_query,'huiles');
            if($request->has('sv-a'))
                array_push($specified_query,'accessoires');
            if($request->has('sv-g'))
                array_push($specified_query,'garage');
            if($request->has('sv-p'))
                array_push($specified_query,'pieces');
            if($request->has('sv-m'))
                array_push($specified_query,'vente_moto');
            if($request->has('sv-per'))
                array_push($specified_query,'personnalisation');

        }

        if(!$search) {

            if($request->isXmlHttpRequest()) {

                if($request->has('more')) {

                    $from = (int) $request->get('more') + 1;

                    $list = $this->lieux->getPlaceRadomly($from,10,$specified_query);

                    return response()->json(['list'=>$list,'n'=>$list->count()]);

                }

            }

            $thatPlace = $this->lieux->getPlaceRadomly(0,10,$specified_query);

            $thatPlace = ['place'=>$thatPlace];

            return view('partial.services',compact('thatPlace'));

        }


        if($request->isXmlHttpRequest()) {

            if($request->has('more')) {

                $from = $request->get('more');
                $limit = 10;
                $list = $this->lieux->allWhereByLimit($search,$specified_query,$d,$locality,$from,$limit);
                $n = $list->count();
                return response()->json(['list'=>$list,'d'=>$d,'n'=>$n]);

            }

        }

        $thatPlace = $this->lieux->allWhere($search,$specified_query,$d,$locality);

        $thatPlace = array_merge_recursive(['place'=>$thatPlace] , ['center'=>[
            'lat' => $search->latitude,
            'lng' => $search->longitude
        ]]);


        return view('partial.services',compact('thatPlace'));
        
    }
}
