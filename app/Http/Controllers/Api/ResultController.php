<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Results\ResultCreateRequest;
use App\Repositories\Results\ResultRepository;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $resultRepository;
    public function __construct(ResultRepository $result)
    {
        $this->resultRepository = $result;
    }

    public function destroy($id)
    {
        $this->resultRepository->delete($id);
        return response()->json(["OK"]);
    }

}
