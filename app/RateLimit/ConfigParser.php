<?php
namespace App\RateLimit;

class ConfigParser {
    public function getConfigValueAsDateInterval(){
        $rateLimit = config('api.rate_limit_interval');
        if ($rateLimit) {
            if (preg_match('/^([0-9]+)(m|h)$/', $rateLimit, $matches)){
                switch($matches[2]){
                    case 'm':
                        $interval = new \DateInterval('PT'.$matches[1].'M');
                        return $interval;
                    case 'h':
                        $interval = new \DateInterval('PT'.$matches[1].'H');
                        return $interval;
                }
            }
        }
    }

    public function getConfigCount(){
        return config('api.rate_limit_count');
    }
}
