<?php

namespace App\Http\Middleware;

use App\Actions\StudentBalance;
use App\Actions\StudentBlocks;
use Closure;
use Illuminate\Http\Request;

class CheckStudentBlockStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $studentBlock = new StudentBlocks;
        
        $studentBalance = new StudentBalance;

        if($studentBlock->isStudentBlocked($studentBalance))
        {
            return redirect()->route('student.block');
        }

        return $next($request);
    }
}
