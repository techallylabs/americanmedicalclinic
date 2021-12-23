<?php
/**
 * Video Url Parser
 *
 * Parses URLs from major cloud video providers. Capable of returning
 * keys from various video embed and link urls to manipulate and
 * access videos in various ways.
 */
class VideoUrlParser
{

	public static function identify_service($url)
	{
		if (preg_match('%youtube|youtu\.be%i', $url)) {
			return 'youtube';
		}
		elseif (preg_match('%vimeo%i', $url)) {
			return 'vimeo';
		}
		elseif (preg_match('/^.*\.(mp4|mov)$/i', $url) || preg_match('/^.*\.(mp4|mov)$/i', $url)) {
			return 'mp4';
		}
		return null;
	}

	public static function get_url_id($url)
	{
		$service = self::identify_service($url);
		if ($service == 'youtube') {
			return self::get_youtube_id($url);
		}
		elseif ($service == 'vimeo') {
			return self::get_vimeo_id($url);
		}
		return null;
	}

	public static function get_url_embed($url)
	{
		$service = self::identify_service($url);
		$id = self::get_url_id($url);
		if ($service == 'youtube') {
			return self::get_youtube_embed($id);
		}
		elseif ($service == 'vimeo') {
			return self::get_vimeo_embed($id);
		}
		elseif ($service == 'mp4') {
			return $url;
		}
		return null;
	}

	public static function get_youtube_id($url)
	{
		$youtube_url_keys = array('v','vi');
		// Try to get ID from url parameters
		$key_from_params = self::parse_url_for_params($url, $youtube_url_keys);
		if ($key_from_params) return $key_from_params;
		// Try to get ID from last portion of url
		return self::parse_url_for_last_element($url);
	}

	public static function get_youtube_embed($youtube_video_id, $autoplay = 1)
	{
		$embed = "https://youtube.com/embed/$youtube_video_id?rel=0&amp;controls=0&amp;showinfo=0";
		return $embed;
	}

	public static function get_vimeo_id($url)
	{
		// Try to get ID from last portion of url
		if (preg_match('#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m)) {
        return $m[1];
    }
    return false;
	}

	public static function get_vimeo_embed($vimeo_video_id, $autoplay = 1)
	{
		$embed = "https://player.vimeo.com/video/$vimeo_video_id?byline=0&amp;portrait=0&amp";
		return $embed;
	}

	public static function get_cover($url)
	{
		$service = self::identify_service($url);
		if ($service == 'youtube') {
			return 'https://img.youtube.com/vi/'.self::get_youtube_id($url).'/maxresdefault.jpg';
		}
		elseif ($service == 'vimeo') {
			$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.self::get_vimeo_id($url).'.php'));
			return $hash[0]['thumbnail_large'];
		}
		return null;
	}

	public static function get_background_video($url, $quality = '1080p')
	{
    $service = self::identify_service($url);
		if($service == 'mp4') {
			return '<video class="jquery-background-video" playsinline muted loop src="'.esc_url($url).'" type="video/mp4" preload="none"></video>';
		} else if($service == 'youtube') {
			$o_array = json_decode(self::parse_youtube_url(self::get_url_id($url)));
			$array = array();


			if(is_array($o_array) && count($o_array) > 0) {
				foreach ($o_array as $video_item) {
					if($video_item->quality_label == '1440p' && !array_search('1440p', array_keys($array))) {
						$array[$video_item->quality_label] = array(
							'url' => $video_item->url,
							'mime' => explode(';', $video_item->type)[0],
							'quality' => $video_item->quality_label
						);
					}
					if($video_item->quality_label == '1080p' && !array_search('1080p', array_keys($array))) {
						$array[$video_item->quality_label] = array(
							'url' => $video_item->url,
							'mime' => explode(';', $video_item->type)[0],
							'quality' => $video_item->quality_label
						);
					}
					if($video_item->quality_label == '720p' && !array_search('720p', array_keys($array))) {
						$array[$video_item->quality_label] = array(
							'url' => $video_item->url,
							'mime' => explode(';', $video_item->type)[0],
							'quality' => $video_item->quality_label
						);
					}
				}

				if($quality && array_search($quality, array_keys($array))) {
					$result_array = $array[$quality];
				} else {
					$result_array = array_shift($array);
				}

				foreach ($o_array as $audio_item) {
					if(isset($audio_item->audio_sample_rate)) {
						if($audio_item->audio_sample_rate == '48000') {
							$audio_url = $audio_item->url;
							$audio_type = explode(';', $audio_item->type)[0];
							break;
						} else if($audio_item->type == '44100') {
							$audio_url = $audio_item->url;
							$audio_type = explode(';', $audio_item->type)[0];
							break;
						}
					}
				}

				return '<div class="video" data-type="youtube">
					<video class="jquery-background-video youtube-video" playsinline muted loop src="'.esc_url($result_array['url']).'" type="'.esc_attr($result_array['mime']).'" data-quantity="'.esc_attr($result_array['quality']).'"></video>
					<audio class="video-js" controls preload="none" muted src="'.esc_url($audio_url).'" type="'.esc_attr($audio_type).'" style="display: none;"></audio>
				</div>';
			}
		} else if($service == 'vimeo') {
			$o_array = json_decode(file_get_contents('https://player.vimeo.com/video/'.self::get_url_id($url).'/config'));
			if(!empty($o_array) && isset($o_array->request->files->progressive) && count($o_array->request->files->progressive) > 0) {
				$array = array();
				$result_array = array();

				foreach ($o_array->request->files->progressive as $video_item) {
					$array[$video_item->quality] = array(
						'mime' => $video_item->mime,
						'url' => $video_item->url,
						'quality' => $video_item->quality
					);
				}

				if($quality && array_search($quality, array_keys($array))) {
					$result_array = $array[$quality];
				} else {
					$result_array = array_shift($array);
				}

				return '<div class="video"><video class="jquery-background-video" playsinline muted loop src="'.esc_url($result_array['url']).'" type="'.esc_attr($result_array['mime']).'" data-quantity="'.esc_attr($result_array['quality']).'" preload="none"></video></div>';
			} else {
				return false;
			}
		}
		return null;
	}

	public static function get_player($url)
	{
		$service = self::identify_service($url);
		$id = self::get_url_id($url);
		if($service == 'mp4') {
			return '<video controls class="pswp__video" width="1920" height="1080" src="'.esc_url($url).'" type="video/mp4"></video>';
		} else if($service == 'youtube') {
			return '<iframe class="pswp__video" width="1920" height="1080" src="'.esc_url(self::get_youtube_embed($id)).'" frameborder="0" allowfullscreen=""></iframe>';
		} else if($service == 'vimeo') {
			return '<iframe class="pswp__video" width="1920" height="1080" src="'.esc_url(self::get_vimeo_embed($id)).'" frameborder="0" allowfullscreen=""></iframe>';
		}
		return null;
	}

	public static function get_time_format($seconds) 
	{
		if($seconds >= 3600) {
			return gmdate("H:i:s", $seconds);
		} else {
			return gmdate("i:s", $seconds);
		}
		return null;
	}

	public static function get_duration($url)
	{
		$service = self::identify_service($url);
		if ($service == 'youtube') {
			$videoDetails = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".self::get_youtube_id($url)."&part=contentDetails,statistics&key=AIzaSyBSW6ZP4p7njnMq_QbgV2nK5L-vfK7zCB4");
			if(empty(self::get_youtube_id($url))) return false;
			$VidDuration = json_decode($videoDetails, true);
			foreach ($VidDuration['items'] as $vidTime) {
				$VidDuration = $vidTime['contentDetails']['duration'];
			}
			$pattern = '/PT(\d+)M(\d+)S/';
			preg_match($pattern,$VidDuration,$matches);
			$seconds = $matches[1]*60+$matches[2];
			$duration = self::get_time_format($seconds);
			return $duration;
		}
		elseif ($service == 'vimeo') {
			$json_url = 'http://vimeo.com/api/v2/video/' . self::get_vimeo_id($url) . '.xml';
			if(!function_exists('curl_init') || empty(self::get_vimeo_id($url))) return false;
			$ch = curl_init($json_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			curl_close($ch);
			$data = new SimpleXmlElement($data, LIBXML_NOCDATA);

			if (!isset($data->video->duration)) {
				return false;
			}

			$seconds = intval($data->video->duration);
			$duration = self::get_time_format($seconds);
			return $duration;
		}
	}

	private static function parse_url_for_params($url, $target_params)
	{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_params );
		foreach ($target_params as $target) {
			if (array_key_exists ($target, $my_array_of_params)) {
				return $my_array_of_params[$target];
			}
		}
		return null;
	}

	private static function parse_url_for_last_element($url)
	{
		$url_parts = explode("/", $url);
		$prospect = end($url_parts);
		$prospect_and_params = preg_split("/(\?|\=|\&)/", $prospect);
		if ($prospect_and_params) {
			return $prospect_and_params[0];
		} else {
			return $prospect;
		}
		return $url;
	}

	private static function parse_youtube_url($id) 
	{
		$dt=file_get_contents("https://www.youtube.com/get_video_info?video_id=$id&el=embedded&ps=default&eurl=&gl=US&hl=en");
    if (strpos($dt, 'status=fail') !== false) {
        
        $x=explode("&",$dt);
        $t=array(); $g=array(); $h=array();
        foreach($x as $r){
            $c=explode("=",$r);
            $n=$c[0]; $v=$c[1];
            $y=urldecode($v);
            $t[$n]=$v;
        }
            $x=explode("&",$dt);
            foreach($x as $r){
                $c=explode("=",$r);
                $n=$c[0]; $v=$c[1];
                $h[$n]=urldecode($v);
            }
            $g[]=$h;
            $g[0]['error'] = true;
            $g[0]['instagram'] = "egy.js";
            $g[0]['apiMadeBy'] = 'El-zahaby';
        return json_encode($g,JSON_PRETTY_PRINT);
        
    } else {
        
        $x=explode("&",$dt);
        $t=array(); $g=array(); $h=array();
        foreach($x as $r){
            $c=explode("=",$r);
            $n=$c[0]; $v=$c[1];
            $y=urldecode($v);
            $t[$n]=$v;
        }
        $streams = explode(',',urldecode($t['url_encoded_fmt_stream_map']));
        
        
        foreach($streams as $dt){ 
            $x=explode("&",$dt);

            foreach($x as $r){
                $c=explode("=",$r);
                $n=$c[0]; $v=$c[1];
                $h[$n]=urldecode($v);
            }
            $g[]=$h;
        }


        $adv = explode(',',urldecode($t['adaptive_fmts']));
        foreach($adv as $dt){ 
            $x=explode("&",$dt);

            foreach($x as $r){
                $c=explode("=",$r);
                $n=$c[0]; $v=$c[1];
                $h[$n]=urldecode($v);
            }
            $g2[]=$h;
        }
        return json_encode($g2,JSON_PRETTY_PRINT);
    }
	}
}
 ?>