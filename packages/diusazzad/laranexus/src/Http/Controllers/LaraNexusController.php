<?php

namespace Diusazzad\LaraNexus\Http\Controllers;

use Diusazzad\LaraNexus\Support\ProjectTreeGenerator;
use Diusazzad\LaraNexus\Support\RouteMapCollector;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class LaraNexusController extends Controller
{
    /**
     * Display the LaraNexus dashboard with dynamic data.
     */
    public function index(RouteMapCollector $collector, ProjectTreeGenerator $treeGenerator): View
    {
        $mermaidString = $collector->generateMermaidString();
        $projectTree = $treeGenerator->generateTree();

        return view('laranexus::dashboard', [
            'mermaidString' => $mermaidString,
            'projectTree' => $projectTree
        ]);
    }
}
