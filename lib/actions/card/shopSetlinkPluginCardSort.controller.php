<?php


class shopSetlinkPluginCardSortController extends waJsonController
{
	public function execute()
	{
		$cards = waRequest::post('cards', '', 'string');
		if(!mb_strlen($cards)) {$this->response = array('result' => 0, 'message' => 'Системная ошибка #NOARR'); return;}
        $cards = str_replace("cards= ", "", $cards);
        $arrCards = explode(',', $cards);
            
		$setlink = waSystem::getInstance('shop')->getPlugin('setlink');
		$this->response = $setlink->sortCard($arrCards);
	}
}