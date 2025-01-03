<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Interfaces\STUServiceInterface as STUService;
use Illuminate\Support\Facades\Auth;

class STUController extends Controller
{
    protected $STUService;
    
    public function __construct(STUService $STUService)
    {
        $this->STUService = $STUService;
    }

    public function index(Request $request)
    {  
        $searchParams = $request->only('keyword', 'created_at', 'level');

        $links = $this->STUService->listOwnSTUPaginated($searchParams);
        
        return view('backend.member.stu-link.index', compact('links'));
    }

    public function destroy(string $alias)
    {
        $destroy = $this->STUService->deleteOwnSTU($alias, Auth::user()->id);
        
        if ($destroy) {
            return redirect()->route('member.stu_links')
            ->with('success', 'Đã xoá liên kết STU: <b>'.$alias.'</b> thành công!');
        }

        return redirect()->route('member.stu_links')
            ->with('error', 'Không thể xoá liên kết STU: <b>'.$alias.'</b>, thử lại sau!');
    }
}
