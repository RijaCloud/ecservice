<?php

    namespace App\Repository;

    use App\Models\Moto;

    class MotoRepository extends  BaseRepository {

        public function __construct(Moto $model)
        {
            $this->model = $model;

        }

        public function store($id, $input,$input2) {

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
            $moto->latitude = $input2['latitude'];
            $moto->longitude = $input2['longitude'];
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
            $moto->garage = $input->has('garage') ? true : false;
            $moto->accessoires = $input->has('accessoires') ? true : false;
            $moto->huiles = $input->has('huiles') ? true : false;
            $moto->pieces = $input->has('pieces') ? true : false;
            $moto->personnalisation = $input->has('personnalisation') ? true : false;
            $moto->vente_moto = $input->has('vente_moto') ? true : false;

            $moto->update();

        }
    }