<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\DistrictRequest;
use App\Http\Requests\FokontanyRequest;
use App\Http\Requests\ProvinceRequest;
use App\Http\Requests\TownRequest;
use App\Repository\ProvinceRepository;
use App\Repository\TerritoryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TerritoryController extends Controller
{
    /**
     * @var TerritoryRepository
     */
    private $repository;

    /**
     * TerritoryController constructor.
     * @param TerritoryRepository $repository
     * @internal param ProvinceRepository $province
     */
    public function __construct(TerritoryRepository $repository) {

        $this->repository = $repository;
    }

    /**
     * Return the country view
     * If the current Request is XMLHttpRequest , it return a partial view
     * Else return an entire view
     * @param \Illuminate\Http\Request
     *
     * */
    public function country(Request $request) {

        $latest = $this->repository->allRegion(5);
        $parent = $this->repository->allProvince();
        
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.country',compact('latest','parent'));
        } else {
            return view('admin.territory.country',compact('latest','parent'));
        }

    }

    /**
     * Add a new contry
     * @param CountryRequest $request
     */
    public function createCountry(CountryRequest $request) {

        $this->repository->storeRegion($request->except('_token'));

    }

    /**
     * Read on country
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function readCountry(Request $request, $id) {
        $id = explode('-',$id)[0];

        $place = $this->repository->oneRegion($id);
        $parent = $this->repository->allProvince();
        if($request->isXmlHttpRequest()) {
            return $place;
        } else {
            return view('admin.territory.view-country',compact('place','parent'));
        }
        
    }

    /**
     * Update a country
     * @param CountryRequest $request
     * @param $id
     */
    public function updateCountry(CountryRequest $request, $id) {
        
        $this->repository->updateRegion($id, $request->except('_token'));
            
    }
    
    public function allCountry() {
        
        $data = $this->repository->allRegion();
        
        return view('admin.territory.allcountry',['latest'=>$data]);
        
    }
    
    /**
     * Return the town view
     * If the current Request is XMLHttpRequest , it return a partial view
     * Else return an entire view
     * @param \Illuminate\Http\Request
     *
     * */
    public function town(Request $request) {

        $latest = $this->repository->allCommune(5);
        $parent = $this->repository->allDistrict();
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.town',compact('latest','parent'));
        } else {
            return view('admin.territory.town',compact('latest','parent'));
        }

    }

    /**
     * Store new Commune
     * @param TownRequest $request
     */
    public function createTown(TownRequest $request) {

        $this->repository->storeCommune($request->except('_token'));

    }


    /**
     * Read one town
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function readTown(Request $request, $id) {
        $id = explode('-',$id)[0];

        $place = $this->repository->oneCommune($id);
        $parent = $this->repository->allDistrict();
        if($request->isXmlHttpRequest()) {
            return $place;
        } else {
            return view('admin.territory.view-town',compact('place','parent'));
        }

    }
    
    public function allTown() {
        
        $data = $this->repository->allCommune();
        
        return view('admin.territory.alltown',['latest'=>$data]);
        
    }

    public function updateTown($id,TownRequest $request) {

        $this->repository->updateCommune($id,$request->except('_token'));

    }
    
    /**
     * Return the province view
     * If the current Request is XMLHttpRequest , it return a partial view
     * Else return an entire view
     * @param \Illuminate\Http\Request
     *
     * */
    public function province(Request $request) {

        $latest = $this->repository->allProvince(5);
        
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.province',compact('latest'));
        } else {
            return view('admin.territory.province',compact('latest'));
        }

    }

    /**
     * Create and add a new Province into the database
     * @param ProvinceRequest $request
     */
    public function createProvince(ProvinceRequest $request) {

        $this->repository->storeProvince($request->except('_token'));
        
    }


    /**
     * Read one province
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function readProvince(Request $request, $id) {
        $id = explode('-',$id)[0];

        $place = $this->repository->oneProvince($id);

        if($request->isXmlHttpRequest()) {
            return $place;
        } else {
            return view('admin.territory.view-province',compact('place'));
        }

    }

    
    public function allProvince() {
        
        $data = $this->repository->allProvince();
        
        return view('admin.territory.allprovince',['latest'=>$data ]);
        
    }

    public function updateProvince($id,ProvinceRequest $request) {

        $this->repository->updateProvince($id,$request->except('_token'));

    }


    public function state() {

        return view('admin.territory.state');

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function fokontany(Request $request) {

        $latest = $this->repository->allFokontany(5);
        
        $parent = $this->repository->allCommune();

        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.fokontany',compact('latest','parent'));
        } else {
            return view('admin.territory.fokontany',compact('latest','parent'));
        }

    }

    /**
     * @param FokontanyRequest $request
     */
    public function createFokontany(FokontanyRequest $request){
        
        $this->repository->storeFokontany($request->except('_token'));
        
    }
    
    /**
     * 
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function readFokontany(Request $request, $id) {
        $id = explode('-',$id)[0];

        $place = $this->repository->oneFokontany($id);

        $parent = $this->repository->allCommune();
        if($request->isXmlHttpRequest()) {
            return $place;
        } else {
            return view('admin.territory.view-fokontany',compact('place','parent'));
        }

    }
    
    public function allFokontany() {
        
        $data = $this->repository->allFokontany();
        
        return view('admin.territory.allfokontany',['latest'=>$data]);
        
        
    }

    public function updateFokontany($id,FokontanyRequest $request) {

        $this->repository->updateFokontany($id,$request->except('_token'));

    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function district(Request $request) {

        $latest = $this->repository->allDistrict(5);
        $parent = $this->repository->allRegion();

        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.departement',compact('latest','parent'));
        } else {
            return view('admin.territory.departement',compact('latest','parent'));
        }

    }


    /**
     * @param DistrictRequest $request
     */
    public function createDistrict(DistrictRequest $request) {

        $this->repository->storeDistrict($request->except('_token'));
    
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function readDistrict(Request $request, $id) {
        $id = explode('-',$id)[0];

        $place = $this->repository->oneDistrict($id);
        $parent = $this->repository->allRegion();
        if($request->isXmlHttpRequest()) {
            return $place;
        } else {
            return view('admin.territory.view-departement',compact('place','parent'));
        }

    }

    public function allDistrict() {
        
        $data = $this->repository->allDistrict();
        
        return view ('admin.territory.alldepartement',['latest'=>$data]);
        
        
    }

    public function updateDistrict($id,DistrictRequest $request) {

        $this->repository->updateDistrict($id,$request->except('_token'));

    }


}
