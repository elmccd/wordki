/**
 *
 * @param text string Text to short
 * @param characters int Number of chars to leave
 * @returns {*} string HTML code with collapse
 */
FS_FUNC={}
FS_FUNC.collapseText = function(text, characters){
    if(text.length>50){
        var html =  text.substring(0,characters);
        html+="<span class='collapse-text'>" + text.substring(characters,1000) + "</span>";
        html+=" <span class='collapse-text-show'>... <a>Rozwiń</a></span>";
        return html;
    }
    return text;
}
FS_FUNC.collapseWords  = function(text, delimiter){
    var parts=text.split(";");
    if(parts.length>4){
        var html =  parts[0] + ';' + parts[1] + ';' + parts[0] + ';' + parts[1];
        parts.splice(0,4);

        html+="<span class='collapse-text'>;" + parts.join(';') + "</span>";
        html+=" <span class='collapse-text-show'><a>Więcej</a></span>";
        return html;
    }
    return text;
}
FS_FUNC.babSpeakIt = function(id) {
    var url = 'http://pl.bab.la/sound/angielski/' + id + '.mp3';
    var a = !!(document.createElement('audio').canPlayType);
    var mp3 = false;
    if (a) {
        var babSO = document.createElement('audio');
        if (babSO.canPlayType) {
            mp3 = !!babSO.canPlayType && "" != babSO.canPlayType('audio/mpeg');
        }
    }
    if (mp3) {
        var ae;
        ae = new Audio("");
        document.body.appendChild(ae);
        ae.src = url;
        ae.addEventListener('canplay', function() {
            ae.play();
        }, false);
    } else {
        speak_html="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='10' height='10'><param name='movie' value='" +url+ "'><param name='quality' value='high'><param name='loop' value='false'><param name='bgcolor' value='#000000'><param name='menu' value='false'><embed src='" +url+ "' loop='false' width='1' height='1' quality='high' bgcolor='#00000f' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' menu='false'></embed></object>";
        speak_html="<object type='application/x-shockwave-flash' data='emff.swf' width='1' height='1'><param name='bgcolor' value='#ffffff'><param name='movie' value='/emff.swf'><param name='FlashVars' value='src=" +url+ "&amp;autoload=yes&amp;autostart=yes'></object>";
        $('body').append(speak_html);
    }
}