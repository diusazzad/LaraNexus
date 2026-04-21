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

        $mermaidLines[] = "    Root[\"<strong>App Routes</strong>\"]:::default";

        foreach ($routes as $route) {
            $action = $route->getActionName();
            
            // Skip ignored namespaces
            if ($this->shouldIgnore($action)) {
                continue;
            }

            $uri = $route->uri();
            $method = implode('|', $route->methods());
            
            // Extract Controller and Method
            if ($action === 'Closure') {
                $controllerName = "Closure";
                $methodName = "Anonymous";
            } else {
                $parts = explode('@', $action);
                $fullController = $parts[0];
                $controllerName = class_basename($fullController);
                $methodName = $parts[1] ?? '__invoke';
            }

            // Create unique IDs for Mermaid nodes
            $routeId = "R_" . md5($uri);
            $ctrlId = "C_" . md5($controllerName);
            $methodId = "M_" . md5($uri . $methodName);

            // Build connections
            $mermaidLines[] = "    Root --- {$routeId}([\"/$uri\"]):::route";
            $mermaidLines[] = "    {$routeId} --> {$ctrlId}[\"$controllerName\"]:::controller";
            $mermaidLines[] = "    {$ctrlId} --> {$methodId}(\"$methodName\"):::method";
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
