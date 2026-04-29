<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraNexus | Interactive Application Mindmap</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe', 300: '#c4b5fd', 400: '#a78bfa', 500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9', 800: '#5b21b6', 900: '#4c1d95', 950: '#2e1065' },
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.min.js"></script>
    <script>
        mermaid.initialize({
            startOnLoad: true,
            theme: 'dark',
            securityLevel: 'loose',
            flowchart: { useMaxWidth: true, htmlLabels: true, curve: 'basis' }
        });
    </script>

    <style>
        .glass-panel { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .mindmap-bg { background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 40px 40px; }
        .mermaid { background: transparent !important; }
        [x-cloak] { display: none !important; }
        .node-highlight { filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.8)); transition: all 0.3s; }
        .node-dimmed { opacity: 0.2; filter: grayscale(100%); transition: all 0.3s; }
        .subgraph-label { fill: #94a3b8 !important; font-weight: 700 !important; font-size: 14px !important; }
        .cluster rect { fill: rgba(30, 41, 59, 0.4) !important; stroke: rgba(148, 163, 184, 0.2) !important; stroke-width: 2px !important; rx: 15; ry: 15; }
    </style>
</head>
<body class="h-full font-sans antialiased mindmap-bg" x-data="laranexus()">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-80 glass-panel border-r border-slate-800 flex flex-col z-10 transition-all duration-300" :class="sidebarOpen ? 'w-80' : 'w-0 overflow-hidden'">
            <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 rounded-lg bg-brand-600 flex items-center justify-center shadow-lg shadow-brand-500/20">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h1 class="text-lg font-bold tracking-tight text-white">LaraNexus</h1>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-6">
                <!-- Search -->
                <div class="relative">
                    <input type="text" x-model="search" @input.debounce.300ms="filterNodes()" placeholder="Search routes, controllers..." class="w-full bg-slate-900/50 border border-slate-800 rounded-lg py-2 pl-10 pr-4 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500/50 transition-all">
                    <svg class="absolute left-3 top-2.5 h-3.5 w-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>

                <!-- Project Tree -->
                <div class="space-y-4">
                    <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-2">App Structure</h3>
                    <div class="space-y-1 text-sm">
                        @foreach($projectTree as $item)
                            @include('laranexus::partials.tree-item', ['item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="p-4 border-t border-slate-800 bg-slate-950/50">
                <div class="flex items-center gap-2 px-2">
                    <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter text-xs">Engine v1.0 Live</span>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 relative flex flex-col min-w-0">
            
            <header class="h-16 flex items-center justify-between px-6 glass-panel border-b border-slate-800 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-slate-800 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span>Workspace</span>
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        <span class="text-slate-200 font-medium">Interactive Mindmap</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <button class="bg-slate-800 border border-slate-700 text-slate-300 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-700 transition-all flex items-center gap-2" @click="exportToSVG()">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        Export SVG
                    </button>
                    <button class="bg-brand-600/10 border border-brand-500/20 text-brand-400 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-brand-600/20 transition-all" onclick="window.location.reload()">
                        Refresh Map
                    </button>
                </div>
            </header>

            <div class="flex-1 overflow-auto flex items-center justify-center p-8">
                <div id="mermaid-container" class="mermaid relative">
                    {!! $mermaidString !!}
                </div>
            </div>

            <!-- Floating Controls -->
            <div class="absolute bottom-8 right-8 flex flex-col gap-2 z-20">
                <div class="p-1.5 glass-panel rounded-xl flex flex-col gap-1 shadow-2xl">
                    <button class="p-2 rounded-lg hover:bg-slate-800 text-slate-400 transition-colors"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg></button>
                    <button class="p-2 rounded-lg hover:bg-slate-800 text-slate-400 transition-colors"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg></button>
                </div>
            </div>
        </main>
    </div>

    <script>
        function laranexus() {
            return {
                sidebarOpen: true,
                search: '',
                
                filterNodes() {
                    const nodes = document.querySelectorAll('.node');
                    if (!this.search) {
                        nodes.forEach(n => n.classList.remove('node-dimmed', 'node-highlight'));
                        return;
                    }

                    const searchTerm = this.search.toLowerCase();
                    nodes.forEach(node => {
                        const label = node.querySelector('.nodeLabel')?.innerHTML.toLowerCase() || '';
                        if (label.includes(searchTerm)) {
                            node.classList.remove('node-dimmed');
                            node.classList.add('node-highlight');
                        } else {
                            node.classList.remove('node-highlight');
                            node.classList.add('node-dimmed');
                        }
                    });
                },

                exportToSVG() {
                    const svg = document.querySelector('#mermaid-container svg');
                    if (!svg) return;

                    const serializer = new XMLSerializer();
                    let source = serializer.serializeToString(svg);
                    
                    if(!source.match(/^<svg[^>]+xmlns="http\:\/\/www\.w3\.org\/2000\/svg"/)){
                        source = source.replace(/^<svg/, '<svg xmlns="http://www.w3.org/2000/svg"');
                    }
                    if(!source.match(/^<svg[^>]+xmlns\:xlink="http\:\/\/www\.w3\.org\/1999\/xlink"/)){
                        source = source.replace(/^<svg/, '<svg xmlns:xlink="http://www.w3.org/1999/xlink"');
                    }

                    const url = "data:image/svg+xml;charset=utf-8," + encodeURIComponent(source);
                    const link = document.createElement("a");
                    link.href = url;
                    link.download = "laranexus-mindmap.svg";
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                },

                openInEditor(path) {
                    if (!path) return;
                    window.location.href = `vscode://file/${path}`;
                }
            }
        }
    </script>
</body>
</html>
