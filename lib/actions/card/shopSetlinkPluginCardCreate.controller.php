<?php
class shopSetlinkPluginCardCreateController extends waJsonController
{
	public function execute()
	{
		$files = waRequest::file('files');
		$setlink = waSystem::getInstance('shop')->getPlugin('setlink');
		$this->response = $setlink->createCardFromPost($files);
	}
}


