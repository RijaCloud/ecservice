<?php

    namespace App\Repository;

    use App\Models\Commune;
    use App\Models\District;
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
        private $district;
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
         * @param District $district
         * @param Fokontany $fokontany
         * @internal param Departement $departement
         */
        public function __construct(Province $province , Region $region , Commune $commune, District $district , Fokontany $fokontany) {

            $this->province = $province;
            $this->region = $region;
            $this->commune = $commune;
            $this->district = $district;
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

            $province->nom = $input['nom'];
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
            
            return $this->province->where('id',$id)->orWhere('nom',$id)->first();
            
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

            $commune->nom = $input['nom'];
            $commune->district_id = $input['district_id'];
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
            
            return $this->commune->where('id',$id)->orWhere('nom',$id)->first();
            
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
         * Update a commune
         * @param $id
         * @param $input
         */
        public function deleteCommune($id , $input) {

            $commune = $this->oneCommune($id);

             return  $commune->delete();

        }
        /**
         * Return all region
         * @param null $limit
         * @return mixed
         */
        public function allRegion($limit  = null) {
            
            if($limit)
                return $this->region->latest()->limit($limit)->get();
            else
                return $this->region->latest()->get();
        }

        public function allRegionWithNumberOfAffiliateChild() {

            

        }

        /**
         * Save a region
         * @param $input
         */
        public function storeRegion($input) {

            $commune = new $this->region;

            $commune->nom = $input['nom'];
            $commune->province_id = $input['province_id'];
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

            return $this->region->where('id',$id)->orWhere('nom',$id)->first();
            
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
        public function allDistrict($limit  = null) {
            if($limit)
                return $this->district->latest()->limit($limit)->get();
            else
                return $this->district->latest()->get();
        }

        /**
         * Store a departement
         * @param $input
         */
        public function storeDistrict($input) {

            $district = new $this->district;

            $district->nom = $input['nom'];
            $district->region_id = $input['region_id'];
            $district->latitude = $input['latitude'];
            $district->longitude = $input['longitude'];
            $district->description = $input['description'];
            $district->save();

        }

        /**
         * Return one departement
         * @param $id
         * @return mixed
         */
        public function oneDistrict($id) {

            return $this->district->where('id',$id)->orWhere('nom',$id)->first();

        }

        /**
         * Update a departement
         * @param $id
         * @param $input
         */
        public function updateDistrict($id , $input) {

            $district = $this->oneDistrict($id);

            $district->update($input);

        }

        /**
         * Return all fokontany
         * @param null $limit
         * @return mixed
         */
        public function allFokontany($limit = null ) {
            if($limit)
                return $this->fokontany->latest()->orderBy('nom','asc')->limit($limit)->get();
            else
                return $this->fokontany->latest()->orderBy('nom','asc')->get();
        }

        /**
         * Store a fokontany
         * @param $input
         */
        public function storeFokontany($input) {
            
            $fokontany = new $this->fokontany;
            
            $fokontany->nom = $input['nom'];
            $fokontany->commune_id = $input['commune_id'];
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