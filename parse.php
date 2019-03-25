<?php
/*
-----[Parse-YouTube-URL]-----
*/
function parseYouTubeURL($url){
    $pattern = '#^(?:https?://)?';    # Optional URL scheme. Either http or https.
    $pattern .= '(?:www\.)?';         #  Optional www subdomain.
    $pattern .= '(?:';                #  Group host alternatives:
    $pattern .= 'youtu\.be/';       #    Either youtu.be,
    $pattern .= '|youtube\.com';    #    or youtube.com
    $pattern .= '(?:';              #    Group path alternatives:
    $pattern .= '/embed/';        #      Either /embed/,
    $pattern .= '|/v/';           #      or /v/,
    $pattern .= '|/watch\?v=';    #      or /watch?v=,
    $pattern .= '|/watch\?.+&v='; #      or /watch?other_param&v=
    $pattern .= ')';                #    End path alternatives.
    $pattern .= ')';                  #  End host alternatives.
    $pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
    $pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : FALSE;
}

#Usage: parseYouTubeURL("embed / watch url");
echo parseYouTubeURL("https://www.youtube.com/watch?v=FzG4uDgje3M");
#Result: FzG4uDgje3M (Return ID)
?>
