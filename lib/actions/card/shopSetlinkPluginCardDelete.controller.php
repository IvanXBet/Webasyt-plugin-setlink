<?php
class shopSetlinkPluginCardDeleteController extends waJsonController
{
	public function execute()
	{
		$card_id = waRequest::post('cardId', null);

		$setlink = waSystem::getInstance('shop')->getPlugin('setlink');
		$this->response = $setlink->deleteCard($card_id);
	}
}


