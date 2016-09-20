<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\DepartementRequest;
use App\Http\Requests\FokontanyRequest;
use App\Http\Requests\ProvinceRequest;
use App\Http\Requests\TownRequest;
use App\Models\Departement;
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

        $latest = $this->repository->allRegion();
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

        $this->repository->storeRegion($request->only('name','parent','description','latitude','longitude'));

    }

    public function readCountry(Request $request, $id) {
        $id = explode('-',$id)[0];

        $place = $this->repository->oneRegion($id);
        $parent = $this->repository->allProvince();
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.view-country',compact('place','parent'));
        } else {
            return view('admin.territory.view-country',compact('place','parent'));
        }
        
    }

    public function updateCountry(CountryRequest $request, $id) {
        
        $this->repository->updateRegion($id, $request->only('name','parent','description','latitude','longitude'));
            
    }
    /**
     * Return the town view
     * If the current Request is XMLHttpRequest , it return a partial view
     * Else return an entire view
     * @param \Illuminate\Http\Request
     *
     * */
    public function town(Request $request) {

        $latest = $this->repository->allCommune();
        $parent = $this->repository->allDepartement();
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

        $this->repository->storeCommune($request->only('name','latitude','parent','longitude','description'));

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
        $parent = $this->repository->allDepartement();    
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.view-town',compact('place','parent'));
        } else {
            return view('admin.territory.view-town',compact('place','parent'));
        }

    }
    /**
     * Return the province view
     * If the current Request is XMLHttpRequest , it return a partial view
     * Else return an entire view
     * @param \Illuminate\Http\Request
     *
     * */
    public function province(Request $request) {

        $latest = $this->repository->allProvince();
        
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

        $this->repository->storeProvince($request->only('name','description','latitude','longitude'));
        
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
            return view('admin.ajaxify.territory.view-province',compact('place'));
        } else {
            return view('admin.territory.view-province',compact('place'));
        }

    }

    public function state() {

        return view('admin.territory.state');

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function fokontany(Request $request) {

        $latest = $this->repository->allFokontany();
        
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
        
        $this->repository->storeFokontany($request->only('name','description','parent','latitude','longitude'));
        
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
            return view('admin.ajaxify.territory.view-fokontany',compact('place','parent'));
        } else {
            return view('admin.territory.view-fokontany',compact('place','parent'));
        }

    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function departement(Request $request) {

        $latest = $this->repository->allDepartement();
        $parent = $this->repository->allRegion();

        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.departement',compact('latest','parent'));
        } else {
            return view('admin.territory.departement',compact('latest','parent'));
        }


    }

    /**
     * @param DepartementRequest $request
     */
    public function createDepartement(DepartementRequest $request) {

        $this->repository->storeDepartement($request->only('name','parent','description','latitude','longitude'));
    
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function readDepartement(Request $request, $id) {
        $id = explode('-',$id)[0];

        $place = $this->repository->oneDepartement($id);
        $parent = $this->repository->allRegion();
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.territory.view-departement',compact('place','parent'));
        } else {
            return view('admin.territory.view-departement',compact('place','parent'));
        }

    }
}
