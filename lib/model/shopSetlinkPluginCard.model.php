<?php 
    class shopSetlinkPluginCardModel extends waModel
    {
        protected $table = "shop_setlink_cards";

        public function getAllSorted($fetch_by = 'id') 
        {
            return $this->query("SELECT * FROM " .$this->table. " ORDER BY sort ASC")->fetchAll($fetch_by);
        }
        public function getMaxSort() 
        {
            $data = $this->query("SELECT MAX(sort) AS mx FROM ".$this->table."")->fetchAll();
            if(!count($data)) {return 0;}
            return $data[0]["mx"];
        }

        public function add($data)
        {
            if(array_key_exists("id", $data)) {unset($data['id']);}
            $data['sort'] = $this->getMaxSort() + 1;
            return $this->insert($data);
        }

        public function remove($id)
        {
            return $this -> deleteById($id);
        }

        public function sortSets($arrSet)
        {

            if(!count($arrSet)) {return;}
            $sort = 1;
            foreach($arrSet as $key => $id) {
                $this->updateById($id, array('sort' => $sort));
                $sort++;
            }
            return array(
                'data' => $arrSet,
                'mas' => 'Готово',
            );
        }

    }