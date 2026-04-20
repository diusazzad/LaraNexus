<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraNexus | Interactive Application Mindmap</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                            950: '#2e1065',
                        },
                    }
                }
            }
        }
    </script>

    <!-- Mermaid.js -->
    <script src="https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.min.js"></script>
    <script>
        mermaid.initialize({
            startOnLoad: true,
            theme: 'dark',
            securityLevel: 'loose',
            flowchart: {
                useMaxWidth: true,
                htmlLabels: true,
                curve: 'basis'
            }
        });
    </script>

    <style>
        .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .mindmap-bg {
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }
        .mermaid {
            background: transparent !important;
        }
    </style>
</head>
<body class="h-full font-sans antialiased mindmap-bg">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-80 glass-panel border-r border-slate-800 flex flex-col z-10">
            <div class="p-6 border-b border-slate-800 flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-brand-600 flex items-center justify-center shadow-lg shadow-brand-500/20">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-white">LaraNexus</h1>
                    <p class="text-xs text-slate-400 font-medium tracking-wider uppercase">Visual Map v1.0</p>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-6">
                <!-- Search -->
                <div class="relative">
                    <input type="text" placeholder="Search Routes..." class="w-full bg-slate-900/50 border border-slate-800 rounded-lg py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all">
                    <svg class="absolute left-3 top-3 h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Project Tree -->
                <div class="space-y-4">
                    <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-widest px-2">Project Structure</h3>
                    <nav class="space-y-1">
                        <div class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-slate-300 hover:bg-slate-800/50 transition-colors cursor-pointer">
                            <svg class="mr-3 h-5 w-5 text-slate-500 group-hover:text-brand-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            Routes
                        </div>
                        <div class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-slate-300 hover:bg-slate-800/50 transition-colors cursor-pointer">
                            <svg class="mr-3 h-5 w-5 text-slate-500 group-hover:text-brand-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Controllers
                        </div>
                        <div class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-slate-300 hover:bg-slate-800/50 transition-colors cursor-pointer">
                            <svg class="mr-3 h-5 w-5 text-slate-500 group-hover:text-brand-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.58 4 8 4s8-1.79 8-4M4 7c0-2.21 3.58-4 8-4s8 1.79 8 4m0 5c0 2.21-3.58 4-8 4s-8-1.79-8-4" />
                            </svg>
                            Models
                        </div>
                    </nav>
                </div>
            </div>

            <div class="p-4 border-t border-slate-800">
                <div class="px-4 py-3 rounded-lg bg-slate-900/50 border border-slate-800">
                    <p class="text-xs text-slate-500 mb-1 leading-relaxed">System Status</p>
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <p class="text-sm font-semibold text-emerald-500">Discovery Active</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 relative flex flex-col min-w-0">
            
            <!-- Header -->
            <header class="h-20 flex items-center justify-between px-8 glass-panel border-b border-slate-800 z-10">
                <div class="flex items-center gap-2 text-sm text-slate-400">
                    <span>Workspace</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <span class="text-white font-medium">Application Mindmap</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <button class="bg-slate-900 border border-slate-800 text-slate-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-slate-800 transition-all flex items-center gap-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        Export Map
                    </button>
                    <button class="bg-brand-600 border border-brand-500 text-white px-5 py-2 rounded-lg text-sm font-bold shadow-lg shadow-brand-600/30 hover:bg-brand-500 transition-all">
                        Refresh Engine
                    </button>
                </div>
            </header>

            <!-- Mindmap Area -->
            <div class="flex-1 overflow-auto flex items-center justify-center p-12">
                <div class="mermaid relative">
                    graph LR
                        %% Styling
                        classDef default fill:#1e293b,stroke:#334155,stroke-width:2px,color:#fff,rx:8,ry:8;
                        classDef route fill:#0f172a,stroke:#3b82f6,stroke-width:2px,color:#fff,rx:8,ry:8;
                        classDef controller fill:#4c1d95,stroke:#8b5cf6,stroke-width:2px,color:#fff,rx:8,ry:8;
                        classDef method fill:#1e1b4b,stroke:#6366f1,stroke-width:2px,color:#fff,rx:8,ry:8;

                        %% Root
                        Root["<strong>LaraNexus Dashboard</strong>"]
                        
                        %% Connection Example
                        Root --- R1[/laranexus]:::route
                        R1 --> C1[LaraNexusController]:::controller
                        C1 --> M1(index):::method

                        %% Feedback
                        class Root brand;
                </div>
            </div>

            <!-- Floating Controls -->
            <div class="absolute bottom-10 right-10 flex flex-col gap-2 z-20">
                <div class="p-2 glass-panel rounded-xl flex flex-col gap-1 shadow-2xl">
                    <button title="Zoom In" class="p-2.5 rounded-lg hover:bg-slate-800 text-slate-300 transition-colors"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg></button>
                    <button title="Zoom Out" class="p-2.5 rounded-lg hover:bg-slate-800 text-slate-300 transition-colors"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg></button>
                    <div class="h-px bg-slate-800 my-1"></div>
                    <button title="Recenter" class="p-2.5 rounded-lg hover:bg-slate-800 text-slate-300 transition-colors"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg></button>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
