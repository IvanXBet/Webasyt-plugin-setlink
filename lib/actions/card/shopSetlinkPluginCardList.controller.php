<?php
class shopSetlinkPluginCardListController extends waJsonController
{
	public function execute()
    {
        $model = new shopSetlinkPluginCardModel();
        $cards = $model->query("SELECT * FROM shop_setlink_cards ORDER BY sort ASC")->fetchAll();
        
        
        foreach ($cards as &$card) {
            $card['photo_url'] = $this->getPath($card);
        }
        $this->response = $cards;
    }

    function getPath($card) 
    {   
        $path = wa()->getDataUrl('plugins/setlink/', true);
        return $card['path'] = $path.$card['id'].'.'.$card['ext'];
    }
}




