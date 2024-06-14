<?php

class shopSetlinkPlugin  extends shopPlugin

{
	/////////////////////////////////////////////////////////////////////////////////////
	// Работа с карточками
	/////////////////////////////////////////////////////////////////////////////////////
	
	public function createCardFromPost($files)
	{
		
		$model = new shopSetlinkPluginCardModel();
		$result = array();
		$path = wa()->getDataPath('plugins/setlink', true);
		$valid_extensions = ['jpg', 'jpeg', 'png', 'svg'];
		
		foreach($files as $file) 
		{
			if(!$file->uploaded()) {$result[] = array('result' => 0, 'message' => 'Не удалось загрузить файл. Проверьте лимиты на размер файла (MAX_UPLOAD_FILESIZE)'); continue;}
			try 
			{
				try
				{
					if((file_exists($path) && !is_writable(($path)) || !file_exists($path) && !waFiles::create($path))) 
					{
						$result[] = array('result' => 0, 'message' => 'Ошибка записи файла. Проверьте права на запись');
					}
					else
					{
						$data = array(
							'name' => pathinfo(basename($file->name), PATHINFO_FILENAME),
							'size' => $file->size,
							'original_filename' => basename($file->name),
							'ext' => $file->extension,
						);
						if (!in_array($file->extension, $valid_extensions)) {
							$result[] = array('result' => 0, 'massage' => 'Расширение файла не подходит для сертификата');
							continue;
						}

						$id = $model->add($data);
						$file->moveTo($path, $id.'.'.$file->extension);
						
						$result[] = array('result' => 1, 'message' => 'Файл загружен', 'card' =>  $model->getById($id));
						
					}
				}
				catch (Exception $e)
				{
					$result[] = array('result' => 0, 'message' => $e->getMessage());
				}
			}
			catch (Exception $e)
			{
				$result[] = array('result' => 0, 'message' => $e->getMessage());
			}
		}
		return $result;
	}

	public function uploadCard($card_id, $text, $url)
	{
		$model = new shopSetlinkPluginCardModel();
		$id = $model->escape($card_id);
		$text = $model->escape($text);
		$url = $model->escape($url);

		$data = array('text' => $text, 'path' => $url);
		
		if(is_numeric($id)) 
		{
			$model->updateById($id ,$data);
			$result[] = array('result' => 1, 'message' => 'Готово', 'file' =>  $model->getById($id));
		}
		else
		{
			$result[] = array('result' => 0, 'message' => 'Ошибка записи');
		}
		return $result;
		
	}

	public function deleteCard($card_id)
	{
		$model = new shopSetlinkPluginCardModel();
		$id = $model->escape($card_id);
		$path = wa()->getDataPath('plugins/setlink/', true);
		
		if(is_numeric($id)) 
		{
			$card = $model->getById($id);
			$model->deleteById($id);
			if(file_exists($path.$card['id'].'.'.$card['ext'])) 
			{
				unlink($path.$card['id'].'.'.$card['ext']);
			}
			
			$result[] = array('result' => 1, 'message' => 'Готово');
		}
		else
		{
			$result[] = array('result' => 0, 'message' => 'Ошибка удаления');
		}
		return $result;
		
	}

	public function sortCard($cards)
	{
		if(!count($cards)) {return array('result' => 0, 'message' => 'Не заданн список для сортировки');}
		$model = new shopSetlinkPluginCardModel();
		return $model->sortSets($cards);
	}
}
