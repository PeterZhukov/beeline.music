<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentAccess extends Model {
    public $table = 'content_access';
    public $timestamps = false;

    public function writeContentAccessLog($contentId, $ip){
        $model = new static();
        $model->content_id = $contentId;
        $model->ip = $ip;
        $model->access_time = (new \DateTime())->format('Y-m-d H:i:s');
        $model->save();
    }

    public function getStatsByContentId($contentId, $limit){
        $counts = \DB::table($this->table)
            ->select('ip', \DB::raw('count(*) as cnt'))
            ->where('content_id', $contentId)
            ->groupBy('ip')
            ->orderBy('cnt', 'desc')
            ->limit($limit)
            ->get();
        return $counts;
    }
}
