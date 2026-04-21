<?php

namespace Diusazzad\LaraNexus\Support;

use Illuminate\Support\Facades\File;

class ProjectTreeGenerator
{
    /**
     * Generate a nested array representation of the project structure.
     */
    public function generateTree(string $path = null): array
    {
        $path = $path ?: base_path('app');
        $tree = [];

        if (!File::isDirectory($path)) {
            return $tree;
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
