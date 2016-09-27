<?php

    namespace App\Repository;

    use App\Models\Commune;
    use App\Models\Departement;
    use App\Models\Fokontany;
    use App\Models\Province;
    use App\Models\Region;

    class TerritoryRepository extends BaseRepository {

        /**
         * @var \App\Models\Province
         */
        private $province;
        /**
         * @var \App\Models\Region
         */
        private $region;
        /**
         * @var \App\Models\Commune
         */
        private $commune;
        /**
         * @var \App\Models\Departement
         * */
        private $departement;
        /**
         * @var  \App\Models\Fokontany
         * */
        private $fokontany;

        /**
         * Initialize all models dependence
         * TerritoryRepository constructor.
         * @param Province $province
         * @param Region $region
         * @param Commune $commune
         * @param Departement $departement
         * @param Fokontany $fokontany
         */
        public function __construct(Province $province , Region $region , Commune $commune, Departement $departement , Fokontany $fokontany) {

            $this->province = $province;
            $this->region = $region;
            $this->commune = $commune;
            $this->departement = $departement;
            $this->fokontany = $fokontany;

        }

        /**
         * Return all province limited or not
         * @param null $limit
         * @return mixed
         */
        public function allProvince($limit = null) {

            if($limit)
                return $this->province->latest()->limit($limit)->get();
            else
                return $this->province->latest()->get();
        }

        /**
         * Save a new province
         * @param $input
         */
        public function storeProvince($input) {

            $province = new $this->province;

            $province->nom = $input['name'];
            $province->latitude = $input['latitude'];
            $province->longitude = $input['longitude'];
            $province->description = $input['description'];

            $province->save();

        }

        /**
         * Return one province
         * @param $id
         * @return mixed
         */
        public function oneProvince($id) {
            
            return $this->province->where('id',$id)->first();
            
        }

        /**
         * Update a province
         * @param $id
         * @param $input
         */
        public function updateProvince($id , $input) {
            
            $province = $this->oneProvince($id);
            
            $province->update($input);
            
        }

        /**
         * Return all commune limited or not
         * @param null $limit
         * @return mixed
         */
        public function allCommune($limit  = null) {

            if($limit)
                return $this->commune->latest()->limit($limit)->get();
            else
                return $this->commune->latest()->get();
        }

        /**
         * Save a new commune
         * @param $input
         */
        public function storeCommune($input) {

            $commune = new $this->commune;

            $commune->nom = $input['name'];
            $commune->departement_id = $input['parent'];
            $commune->latitude = $input['latitude'];
            $commune->longitude = $input['longitude'];
            $commune->description = $input['description'];
            $commune->save();

        }

        /**
         * Return one commune
         * @param $id
         * @return mixed
         */
        public function oneCommune($id) {
            
            return $this->commune->where('id',$id)->first();
            
        }

        /**
         * Update a commune
         * @param $id
         * @param $input
         */
        public function updateCommune($id , $input) {
            
            $commune = $this->oneCommune($id);
            
            $commune->update($input);
            
        }

        /**
         * Return all region
         * @param null $limit
         * @return mixed
         */
        public function allRegion($limit  = null) {
            if($limit)
                return $this->region->latest()->limit(function($q) use($limit) {
                    return count($q->all()) > 5 ? 5 : $limit;
                })->get();
            else
                return $this->region->latest()->get();
        }

        /**
         * Save a region
         * @param $input
         */
        public function storeRegion($input) {

            $commune = new $this->region;

            $commune->nom = $input['name'];
            $commune->province_id = $input['parent'];
            $commune->latitude = $input['latitude'];
            $commune->longitude = $input['longitude'];
            $commune->description = $input['description'];
            $commune->save();

        }

        /**
         * Return one region
         * @param $id
         * @return mixed
         */
        public function oneRegion($id) {

            return $this->region->where('id',$id)->first();
            
        }

        /**
         * Update a region
         * @param $id
         * @param $input
         */
        public function updateRegion($id , $input) {
            
            $region = $this->oneRegion($id);
            
            $region->update($input);
            
        }

        /**
         * Return all departement
         * @param null $limit
         * @return mixed
         */
        public function allDepartement($limit  = null) {
            if($limit)
                return $this->departement->latest()->limit($limit)->get();
            else
                return $this->departement->latest()->get();
        }

        /**
         * Store a departement
         * @param $input
         */
        public function storeDepartement($input) {

            $departement = new $this->departement;

            $departement->nom = $input['name'];
            $departement->region_id = $input['parent'];
            $departement->latitude = $input['latitude'];
            $departement->longitude = $input['longitude'];
            $departement->description = $input['description'];
            $departement->save();

        }

        /**
         * Return one departement
         * @param $id
         * @return mixed
         */
        public function oneDepartement($id) {

            return $this->departement->where('id',$id)->orWhere('nom',$id)->first();

        }

        /**
         * Update a departement
         * @param $id
         * @param $input
         */
        public function updateDepartement($id , $input) {

            $departement = $this->oneDepartement($id);

            $departement->update($input);

        }

        /**
         * Return all fokontany
         * @param null $limit
         * @return mixed
         */
        public function allFokontany($limit = null ) {
            if($limit)
                return $this->fokontany->latest()->limit($limit)->get();
            else
                return $this->fokontany->latest()->get();
        }

        /**
         * Store a fokontany
         * @param $input
         */
        public function storeFokontany($input) {
            
            $fokontany = new $this->fokontany;
            
            $fokontany->nom = $input['name'];
            $fokontany->commune_id = $input['parent'];
            $fokontany->latitude = $input['latitude'];
            $fokontany->longitude = $input['longitude'];
            $fokontany->description = $input['description'];
            $fokontany->save();
            
        }

        /**
         * Return one fokontany
         * @param $id
         * @return mixed
         */
        public function oneFokontany($id) {

            return $this->fokontany->where('id',$id)->orWhere('nom',$id)->first();

        }

        /**
         * Update a fokontany
         * @param $id
         * @param $input
         */
        public function updateFokontany($id , $input) {

            $fokontany = $this->oneFokontany($id);

            $fokontany->update($input);

        }
        
        
        
    }