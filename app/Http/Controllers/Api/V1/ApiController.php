<?php
namespace App\Http\Controllers\Api\V1;

use App\Models\ContentAccess;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController {
    public function getImage(Request $request, $id){
        $image = Image::find($id);
        if (!$image){
            throw new NotFoundHttpException('Image not found');
        }
        /** @var ContentAccess $contentAccess */
        $contentAccess = app(ContentAccess::class);
        $contentAccess->writeContentAccessLog($id, $request->ip());

        return response()->file(\Storage::disk('public')->path($image->path));
    }

    public function getStats(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'limit' => ['integer'],
        ]);
        if ($validator->fails()){
            $failed = $validator->failed();
            $attribute = key($failed);
            throw new BadRequestHttpException('Invalid parameter "' . $attribute.'"');
        }
        $image = Image::find($id);
        if (!$image){
            throw new NotFoundHttpException('Image not found');
        }
        $limit = 5;
        if (!empty($request->limit)){
            $limit = $request->limit;
        }
        /** @var ContentAccess $contentAccessModel */
        $contentAccessModel = app(ContentAccess::class);
        $counts = $contentAccessModel->getStatsByContentId($id, $limit);
        $response = [];
        foreach($counts as $count){
            $response[] = [
                'ip' => $count->ip,
                'count' => $count->cnt,
            ];
        }
        return response()->json($response);
    }
}
