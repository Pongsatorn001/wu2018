<?php

class AI
{
    public static function process($text)
    {
        $result = [
            'gender' => self::getGender($text),
            'sentiment' => self::getSentiment($text),
            'rude_words' => self::getRudeWords($text),
            'languages' => self::getLanguages($text),
        ];
        return $result;
    }

    /**
     * @return string 'Male' or 'Female' or 'Unknown'
     */
    public static function getGender($text)
    {
        if (strpos($text, "ครับ")){
            return 'Male';
        }else if (strpos($text, "ค่ะ") !== false){
            return 'Female';
        }else{
            return 'Unknown';
        }
        
    }

    /**
     * @return string 'Positive' or 'Neutral' or 'Negative'
     */
    public static function getSentiment($text)
    {
        if (strpos($text, "สวัสดี") !== false) {
            return 'Positive';
        }
        return 'Neutral';
    }

    /**
     * @return array of all rude words in Thai
     */
    public static function getRudeWords($text)
    {
        if (strpos($text, "ควย") !== false) {
            return ['คำหยาบ'];
        }
        return ['คำสุภาพ'];
    }

    /**
     * @return array of languages (TH, EN)
     */
    public static function getLanguages($text)
    {
        $result = [];
        $re = '/[ก-๛]+/u';
        preg_match_all($re, $text, $matches, PREG_SET_ORDER, 0);
        if (!empty($matches)) {
            array_push($result, 'TH');
        }
        return $result;
    }
}
