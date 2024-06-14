<?php
class shopSetlinkPluginCardUpdateController extends waJsonController
{
	public function execute()
	{
		$card_id = waRequest::post('cardId', null);
		$text = waRequest::post('textValue', null);
		$url = waRequest::post('urlValue', null);


		$setlink = waSystem::getInstance('shop')->getPlugin('setlink');
		$this->response = $setlink->uploadCard($card_id, $text, $url);
	}
}


