<?php

namespace Diusazzad\LaraNexus\Support;

use Illuminate\Support\Facades\Route;
use ReflectionClass;

class RouteMapCollector
{
    /**
     * Namespaces to ignore during route discovery.
     */
    protected array $ignoredNamespaces = [
        'Facade\Ignition',
        'Laravel\Tinker',
        'Spatie\LaravelRay',
        'Diusazzad\LaraNexus',
        'Illuminate\Routing',
        'App\Providers',
    ];

    /**
     * Generate a Mermaid.js compatible string from application routes.
     */
    public function generateMermaidString(): string
    {
        $routes = Route::getRoutes();
        $mermaidLines = ["graph LR"];
        
        // Styling Classes
        $mermaidLines[] = "    classDef route fill:#0f172a,stroke:#3b82f6,stroke-width:2px,color:#fff,rx:8,ry:8;";
        $mermaidLines[] = "    classDef controller fill:#4c1d95,stroke:#8b5cf6,stroke-width:2px,color:#fff,rx:8,ry:8;";
        $mermaidLines[] = "    classDef method fill:#1e1b4b,stroke:#6366f1,stroke-width:2px,color:#fff,rx:8,ry:8;";
        $mermaidLines[] = "    classDef model fill:#7c2d12,stroke:#f97316,stroke-width:2px,color:#fff,rx:5,ry:5;";
        $mermaidLines[] = "    classDef view fill:#064e3b,stroke:#10b981,stroke-width:2px,color:#fff,rx:2,ry:2;";
        $mermaidLines[] = "    classDef middleware fill:#991b1b,stroke:#ef4444,stroke-width:1px,color:#fff,rx:10,ry:10,font-size:10px;";

        $mermaidLines[] = "    Root[\"<strong>App Routes</strong>\"]:::default";

        $controllers = [];

        foreach ($routes as $route) {
            $action = $route->getActionName();
            if ($this->shouldIgnore($action)) continue;

            $uri = $route->uri();
            $methods = implode('|', $route->methods());
            $middleware = implode(', ', (array) $route->middleware());
            
            if ($action === 'Closure') {
                $controllerName = "Closures";
                $methodName = "Anonymous";
            } else {
                $parts = explode('@', $action);
                $fullController = $parts[0];
                $controllerName = class_basename($fullController);
                $methodName = $parts[1] ?? '__invoke';
            }

            $controllers[$controllerName]['full'] = $fullController ?? 'Closure';
            $controllers[$controllerName]['routes'][] = [
                'uri' => $uri,
                'method' => $methods,
                'action' => $methodName,
                'middleware' => $middleware,
                'full_action' => $action
            ];
        }

        foreach ($controllers as $name => $data) {
            $ctrlId = "C_" . md5($name);
            $mermaidLines[] = "    subgraph {$ctrlId} [\"$name\"]";
            
            foreach ($data['routes'] as $r) {
                $routeId = "R_" . md5($r['uri']);
                $methodId = "M_" . md5($r['uri'] . $r['action']);
                
                // Route Node with Middleware
                $label = "/{$r['uri']}";
                if ($r['middleware']) {
                    $label .= " <br/><small>🔐 {$r['middleware']}</small>";
                }

                $mermaidLines[] = "        {$routeId}([\"$label\"]):::route";
                $mermaidLines[] = "        {$methodId}(\"{$r['action']}\"):::method";
                $mermaidLines[] = "        {$routeId} --> {$methodId}";

                // Discovery Logic (Same as before but nested)
                if ($r['full_action'] !== 'Closure' && class_exists($data['full'])) {
                    $reflection = new ReflectionClass($data['full']);
                    $path = $reflection->getFileName();
                    if ($path) {
                        $mermaidLines[] = "        click {$ctrlId} \"vscode://file/{$path}\" \"Open $name in VS Code\"";
                        $content = file_get_contents($path);
                        
                        preg_match_all('/use App\\\Models\\\([a-zA-Z]+);/', $content, $modelMatches);
                        foreach (array_unique($modelMatches[1]) as $modelName) {
                            $modelId = "Mod_" . md5($modelName);
                            $mermaidLines[] = "        {$methodId} -- uses --> {$modelId}[(\"DB: $modelName\")]:::model";
                        }

                        preg_match_all('/view\([\'"]([a-zA-Z0-9._-]+)[\'"]\)/', $content, $viewMatches);
                        foreach (array_unique($viewMatches[1]) as $viewName) {
                            $viewId = "V_" . md5($viewName);
                            $mermaidLines[] = "        {$methodId} -- renders --> {$viewId}[[\"View: $viewName\"]]:::view";
                        }
                    }
                }
            }
            $mermaidLines[] = "    end";
            $mermaidLines[] = "    Root --- {$ctrlId}";
        }

        return implode("\n", $mermaidLines);
    }

    /**
     * Determine if a route action should be ignored.
     */
    protected function shouldIgnore(string $action): bool
    {
        foreach ($this->ignoredNamespaces as $namespace) {
            if (str_starts_with($action, $namespace)) {
                return true;
            }
        }
        return false;
    }
}
