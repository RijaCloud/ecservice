<?php 

namespace App\Repository;

use App\Models\Lieu;
use App\Models\Moto;
use Illuminate\Support\Facades\DB;

class LieuRepository {
    
    /**
     * \App\Models\Lieu
     * @var model
     * */
    protected $model ;
    /**
     * \App\Models\Moto
     * @var Moto
     */
    private $moto;

    public function __construct(Lieu $lieu , Moto $moto)
   {
       $this->model = $lieu;
       $this->moto = $moto;
   }

    /**
     * Retourne une liste d'information au hasard
     * @param $limit integer limite de resultat
     * @return mixed
     */
    public function getByRandom($limit) {

        return $this->moto->random($limit);
    }

    /**
     * Retourne une liste de lieu au hasard
     * @param $limit
     * @return mixed
     */
    public function getPlaceRadomly($limit) {

        return $this->model->random($limit)->get();
        
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getRandom($limit = 10) {

        return $this->getByRandom($limit)->get();

    }

    /**
     * Retourne une liste de garage
     * @param int $limit
     * @return mixed
     */
    public function getRandomGarage($limit  = 10) {

        return $this->getByRandom($limit)->garage()->with('lieu')->get();

    }

    /**
     * Retourne une liste de vendeur de pieces
     * @param int $limit
     * @return mixed
     */
    public function getRandomPart($limit = 10) {

        return $this->getByRandom($limit)->pieces()->with('lieu')->get();

    }

    /**
     * Retourne une liste de vendeur de moto
     * @param int $limit
     * @return mixed
     */
    public function getRandomCycle($limit = 10) {

        return $this->getByRandom($limit)->moto()->with('lieu')->get();

    }

    /**
     * Retourne une liste de vendeur d'accessoire
     * @param int $limit
     * @return mixed
     */
    public function getRandomAccessory($limit = 10) {

        return $this->getByRandom($limit)->accessoires()->with('lieu')->get();

    }

    /**
     * Retourne une liste de vendeur d'huile
     * @param int $limit
     * @return mixed
     */
    public function getRandomOil($limit = 10) {

        return $this->getByRandom($limit)->huiles()->with('lieu')->get();

    }

    /**
     * Retourne une liste de personnalisateur
     * @param int $limit
     * @return mixed
     */
    public function getRandomPerso($limit = 10) {
        
        return $this->getByRandom($limit)->perso()->with('lieu')->get();
        
    }

    /**
     * Store new data
     * @param $input
     * @return mixed
     */
    public function store($input) {

        $place = new $this->model;

        $place->string_lieu = $input['name'];
        $place->fokontany_id = $input['fokontany'];
        $place->description = $input['description'];
        $place->longitude = $input['longitude'];
        $place->latitude = $input['latitude'];
        $place->commune_id = $input['commune'];
        $place->departement_id = $input['departement'];
        $place->region_id = $input['region'];
        $place->province_id = $input['province'];
        $place->moto = true;
        
        if($place->save())
            return $place->id;
        
    }

    /**
     * Retourne une liste de lieux
     * @return mixed
     */
    public function latest() {

        return $this->model->latest()->limit(5)->get();

    }

    /**
     * Retourne un lieu par l'ID
     * @param $id
     * @return mixed
     */
    public function getById($id) {

        return $this->model->where('id',$id);
    }

    /**
     * Supprime un lieu par l'ID
     * @param $id
     * @return mixed
     */
    public function deleteById($id) {

        $place = $this->model->where('id',$id)->first();

        return  $place->delete();
        
    }

    /**
     * Modifie un lieu via l'ID
     * @param $id
     * @param $param
     */
    public function updateById($id, $param) {

        $place = $this->getById($id);
        
        $param = collect($param);
        $newdata = $param->only(['name','description','longitude','latitude','fokontany','commune','departemnet','region','province']);
        $newdata['string_lieu'] = $param->get('name');
        $newdata->forget('name');
        $newdata['fokontany_id'] = $param->get('fokontany');
        $newdata->forget('fokontany');
        $newdata['commune_id'] = $param->get('commune');
        $newdata->forget('commune');
        $newdata['region_id'] = $param->get('region');
        $newdata->forget('region');
        $newdata['province_id'] = $param->get('province');
        $newdata->forget('province');
        $newdata['departement_id'] = $param->get('departement');
        $newdata->forget('departement');

        $place->update($newdata->toArray());
    }

    /**
     * Retourne une liste de lieu
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all() {
        return $this->model->all();
    }

    public function allPlaceWithNoConstraint() {
        return $this->model->whereMoto(true);
    }

    public function byName($name) {
        
        return $this->model->whereNom($name)->with('lieu')->get();
        
    }

    public function allWhereFokontany($param, $specified = []) {

        if(count($specified) != 0) {
            $long_query = $this->moto->where('fokontany_id',$param);
            foreach($specified as $sp) {
                $long_query->$sp();
            }
            return $long_query->with('lieu')->get();
            
        } else {
            return  $this->moto->where("fokontany_id",$param)->with('lieu')->get();

        }


    }
}