<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();
        // Get view file location from menu config
        $view = theme()->getOption('page', 'view');
        
        if (auth()->user()->user_type == 'Student') {
            return redirect()->route('student.dashboard');
        }

        if ($user->hasRole('Academic Dashboard')) {
            return redirect()->route('dashboard.academic');
        }

        if ($user->hasRole('Finance Dashboard')) {
            return redirect()->route('dashboard.finance');
        }
        
        // Check if the page view file exist
        if (view()->exists('pages.'.$view)) {
            return view('pages.'.$view);
        }   
        
        
        // Get the default inner page
        return redirect('/');
    }

    /**
     * Temporary function to replace icon duotone
     */
    public function replaceIcons()
    {
        $fileContent = file_get_contents(public_path('icon_replacement.txt'));
        $lines       = explode("\n", $fileContent);

        $patterns     = [];
        $replacements = [];
        foreach ($lines as $line) {
            $el = explode(' - ', $line);
            if (empty($line)) {
                continue;
            }
            $patterns[]     = trim($el[0]);
            $replacements[] = trim($el[1]);
        }

        $files    = File::allFiles(resource_path());
        $filtered = array_filter($files, function ($str) {
            return strpos($str, ".php") !== false;
        });

        foreach ($filtered as $file) {
            $bladeFileContent = file_get_contents($file->getPathname());

            $bladeFileContent = str_replace($patterns, $replacements, $bladeFileContent);

            file_put_contents($file->getPathname(), $bladeFileContent);
        }
    }

    public function startMenu(){
        $view = theme()->getOption('page', 'view');

        return view('pages.index');
    }
}
