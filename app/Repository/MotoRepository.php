<?php

    namespace App\Repository;

    use App\Models\Moto;

    class MotoRepository extends  BaseRepository {

        public function __construct(Moto $model)
        {
            $this->model = $model;

        }

        public function store($id, $input) {

            $moto = new $this->model;
            $moto->lieu_id = $id;
            $moto->garage = (array_key_exists('garage',$input)) ? true : false;
            $moto->personnalisation = (array_key_exists('peronnalisation',$input)) ? true : false;
            $moto->accessoires = (array_key_exists('accessoires',$input)) ? true : false;
            $moto->pieces = (array_key_exists('pieces',$input)) ? true : false;
            $moto->huiles = (array_key_exists('huiles',$input)) ? true : false;
            $moto->fokontany_id = $input['fokontany'];
            $moto->commune_id = $input['commune'];
            $moto->district_id = $input['district'];
            $moto->region_id = $input['region'];
            $moto->province_id = $input['province'];
            $moto->vente_moto = (array_key_exists('vente_moto',$input)) ? true : false;
            $moto->save();
            
        }

        public function latest() {

            return $this->model->latest()->with('lieu')->limit(5)->get();

        }
        
        public function getPlaceById($id) {

            return $this->model->where('lieu_id',$id)->with('lieu')->first();
            
        }

        public function updateByPlaceId($id, $input) {

            $moto = $this->getPlaceById($id);

            $input = collect($input);
            $input->forget(['name','description','longitude','latitude']);
            $input->put('fokontany_id',(int)$input->get('fokontany'));
            $input->forget('fokontany');
            $garage = $input->has('garage');
            $accessoires = $input->has('accessoires');
            $huiles = $input->has('huiles');
            $pieces = $input->has('pieces');
            $input->merge(['garage'=>$garage,'accessoires'=>$accessoires,'huiles'=>$huiles,'pieces'=>$pieces]);

            $moto->update((array)$input);

        }
    }