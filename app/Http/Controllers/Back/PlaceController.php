<?php

namespace App\Http\Controllers\Back;

use App\Events\ImageToModify;
use App\Events\ImageToUpload;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Jobs\StoreAndSaveImage;
use App\Repository\LieuRepository;
use App\Repository\MotoRepository;
use App\Repository\TerritoryRepository;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlaceController extends Controller
{

    /**
     * @var TerritoryRepository
     */
    private $repository;
    
    private $place;
    
    private $moto;


    /**
     * PlaceController constructor.
     * @param TerritoryRepository $repository
     * @param PlaceController $place
     */
    public function __construct(TerritoryRepository $repository, LieuRepository $place, MotoRepository $moto)
    {
        $this->repository = $repository;
        $this->place = $place;
        $this->moto = $moto;
    }

    public function index(Request $request) {

        $fokontany = $this->repository->allFokontany();
        $latest = $this->place->latest();
        if($request->isXmlHttpRequest()) {
            return view('admin.ajaxify.place.index',compact('fokontany','latest'));
        } else {
            return view('admin.place.index',compact('fokontany','latest'));
        }

    }
    
    public function all() {
        
        $latest = $this->place->all();
        
        return view('admin.place.all',compact('latest'));
        
    }
    
    public function store(PlaceRequest $request, MotoRepository $moto) {

        $info = $request->only('name','description','fokontany','latitude','longitude');

        $description = array_diff($request->all(),$info);
        $fokontany = $this->repository->oneFokontany($request->input('fokontany'));
        $commune = $this->repository->oneCommune($fokontany['commune_id']);
        $district = $this->repository->oneDistrict($commune['district_id']);
        $region = $this->repository->oneRegion($district['region_id']);
        $province = $this->repository->oneProvince($region['province_id']);

        $new_array = ['fokontany'=>$request->input('fokontany'),'commune'=>$commune->id,'district'=>$district->id,'region'=>$region->id,'province'=>$province->id];

        $merge_array = array_merge($info, $new_array);

        $moto_merge = array_merge($description , $new_array);

        $new_id = $this->place->store($merge_array);

        if($request->hasFile('file')) {

            event(new ImageToUpload($request->file('file'),$new_id));

        }

        if($new_id)
            $moto->store($new_id->id,$moto_merge,$merge_array);
        else
            return new HttpResponseException('error');
        
    }
    
    public function deletePlace($id) {
        $id = explode('-',$id)[0];

        $delete = $this->place->deleteById($id);

        if($delete)
            return back()->withInput(['success'=>'Lieu bien supprimer']);
        
    } 
    
    public function updatePlace(PlaceRequest $request, $id) {
        $id = explode('-',$id)[0];
        $param = $request->except(['_token']);

        $fokontany = $this->repository->oneFokontany($request->input('fokontany'));
        $commune = $this->repository->oneCommune($fokontany['commune_id']);
        $departement = $this->repository->oneDistrict($commune['district_id']);
        $region = $this->repository->oneRegion($departement['region_id']);
        $province = $this->repository->oneProvince($region['province_id']);
        
        $new_array = ['fokontany'=>$request->input('fokontany'),'commune'=>$commune->id,'district'=>$departement->id,'region'=>$region->id,'province'=>$province->id];
        
        $moto_merge = array_merge($param , $new_array);

        if($request->hasFile('file')) {
            event(new ImageToModify($request->file('file'),$id));
        }
        
        $this->place->updateById($id,$moto_merge);
        $this->moto->updateByPlaceId($id,$moto_merge);
    }
    
    public function readPlace(Request $request ,$id) {

        $id = explode('-',$id)[0];

        $place = $this->moto->getPlaceById($id);
       
        if(!is_null($id)) {

            if($request->isXmlHttpRequest()) {
                return response()->json($place);
            } else {

                $fokontany = $this->repository->allFokontany();
                return view('admin.place.read', compact('place','fokontany'));

            }
            
        }
    }
}
