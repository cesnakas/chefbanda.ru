<?php
/**
* Получить список последних видео заданного плейлиста
*
* @param string $ytlist идентификатор плейлиста
* @param int $cnt по сколько позиций обрабатывать (не всегда нужно содержимое всего плейлиста)
* @param int $cache_life время жизни кеша в секундах (чтобы не получить бан IP за рилтайм запросы)
* @return array список найденных видео, не более $cnt штук
*/
function getYoutubePlaylistDataXml($ytlist, $cnt = 5, $cache_life = 3600) {
    # файл, содержащий копию ленты
	//$cache_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . $ytlist . '.json';
    
    # Ключ для запросов
    $api_key = 'AIzaSyB0vW1LhdJ8Plbo4WvqPME9L49uHGYybl0';
    https://www.googleapis.com/youtube/v3/channels?part=contentDetails&forUsername={user_or_channel_name}&key={your_api_key}
    # специальный адрес, отвечающий за выдачу фида
    $url = 'https://www.googleapis.com/youtube/v3/channels?part=contentDetails'
         . '&forUsername=' . $ytlist
         . '&key=' . $api_key;
    $buf = file_get_contents($url);
var_dump($buf);
    # если кеш устарел...
	/* if (time() - @filemtime($cache_file) >= $cache_life) {
        # ...пытаемся обновить его
        $buf = file_get_contents($url);
        # в случае успеха запишем в файл обновлённые данные
        # проверка на пустоту нужна для того, чтобы не запороть кеш при ошибке
        if ($buf) file_put_contents($cache_file, $buf);
	}*/
    
    # если фид получить не удалось...
	/* if (empty($buf)) {
        # ...просто берём содержимое из кеша
        $buf = file_get_contents($cache_file);
	}*/
    
    # декодируем JSON данные
    $json = json_decode($buf, 1);
    
    $arr = array();
    
    # если данных нет — на выход
    if (empty($json['items'])) return $arr;
    
    # перебор доступных значений
    foreach ($json['items'] as $v) {
        $t = array(
            'title' => $v['snippet']['title'], # название
            'desc'  => $v['snippet']['description'], # описание
            'url'   => $v['snippet']['resourceId']['videoId'], # адрес
        );
        
        # изображения
        if (isset($v['snippet']['thumbnails'])) {
            $t['imgs']['all'] = array();
            foreach ($v['snippet']['thumbnails'] as $name => $item) {
                $t['imgs']['all'][] = $item['url'];
                $wh = $item['width'] . 'x' . $item['height'];
                $t['imgs'][$wh][0] = $item['url'];
            }
        }
        
        $arr[] = $t;
    }
    
    return $arr;
}