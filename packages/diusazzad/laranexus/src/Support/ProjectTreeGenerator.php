<?php

declare(strict_types=1);

namespace Diusazzad\LaraNexus\Support;

use Illuminate\Support\Facades\File;

class ProjectTreeGenerator
{
    /**
     * Generate a nested array representation of the project structure.
     */
    public function generateTree(?string $path = null): array
    {
        $path = $path ?: base_path('app');
        $tree = [];

        if (!File::isDirectory($path)) {
            throw new \Diusazzad\LaraNexus\Exceptions\MindmapGenerationException("Directory does not exist: {$path}");
        }

        $items = File::directories($path);
        foreach ($items as $dir) {
            $tree[] = [
                'name' => basename($dir),
                'type' => 'directory',
                'children' => $this->generateTree($dir),
            ];
        }

        $files = File::files($path);
        foreach ($files as $file) {
            $tree[] = [
                'name' => $file->getFilename(),
                'type' => 'file',
                'path' => $file->getRealPath(),
            ];
        }

        return $tree;
    }
}
