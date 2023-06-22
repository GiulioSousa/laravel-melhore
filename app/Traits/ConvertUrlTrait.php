<?php

namespace App\Traits;

use App\Http\Requests\VideoFormRequest;

trait ConvertUrlTrait
{
    public function extractYoutubeId(VideoFormRequest $request)
    {
        $url = $request->url;
        $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})/i';
        
        preg_match($pattern, $url, $match);
        
        if (is_array($match) && isset($match[1])) {
            return $match[1];
        } else {
            return null;
        }
    }
    
    public function generateTemplateUrl(string $urlId): string
    {
        $youtubeTemplate = "http://youtu.be/";
        return $youtubeTemplate . $urlId;
    }
}