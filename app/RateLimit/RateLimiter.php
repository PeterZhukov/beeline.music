<?php
namespace App\RateLimit;

use App\Models\ContentAccess;

class RateLimiter {
    public function checkAccessCount(\DateInterval $interval, $count, $ip){
        $now = new \DateTime();
        $now->sub($interval);
        $dbCount = ContentAccess::where('ip', $ip)->where('access_time', '>', $now->format('Y-m-d H:i:s'))->count();
        if ($dbCount >= $count){
            return false;
        }
        return true;
    }
}
