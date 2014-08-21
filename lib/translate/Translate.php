<?php
namespace App\Lib\Translate;

class Translate extends Crawler {

    private $url;

    private $data;

    public function  __construct(){

    }

    public function setWord($word){
        $this->url = "http://pl.bab.la/slownik/angielski-polski/".urlencode($word);
        $this->getData();
    }

    private function getData(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $xml_response = curl_exec($ch);

        if($this->validateRespond($xml_response)){
            $this->data = $xml_response;
        } else {
            throw new Exception('Strona nie odpowiada, lub nie istnieje');
        }

    }

    public function getAll(){
        echo $this->data;
    }

    public function getWords(){
        $a=explode("Streszczenie</h4>", $this->data);

        $b=explode("javascript:babSpeakIt('angielski',", $a[1]);
        $b=explode(")", $b[1]);
        $sound_id=$b[0];

        $a=explode('<div class="fb-like-wrapper"', $a[1]);
        $a=explode('<div class="quick-result-section"', $a[0]);
        $summary=$a[0];
        //Remove polish words
        $summary=explode("babFlag-pl", $summary);
        $summary=$summary[0];

        $eng=explode('result-link">', $summary);
        $eng=explode('</a>', $eng[1]);
        $eng=$eng[0];

        $words=explode('class="muted-link">', $summary);
        array_shift($words);
        $words_array=array();
        foreach($words as $word) {
            $parts=explode('</a>', $word);
            $words_array[]=$parts[0];
        }
        return array($words_array, $sound_id, $eng);
    }

}
