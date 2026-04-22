<div x-data="{ open: false }" class="select-none">
    <div 
        @click="{{ $item['type'] === 'directory' ? 'open = !open' : "openInEditor('".str_replace('\\', '/', $item['path'])."')" }}" 
        class="group flex items-center px-2 py-1.5 rounded-md hover:bg-slate-800/50 cursor-pointer transition-colors"
        :class="{ 'text-brand-400 bg-brand-600/5': open && '{{ $item['type'] }}' === 'directory' }"
    >
        @if($item['type'] === 'directory')
            <svg 
                class="mr-2 h-4 w-4 text-slate-500 transition-transform duration-200" 
                :class="{ 'rotate-90 text-brand-400': open }"
                fill="none" viewBox="0 0 24 24" stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <svg class="mr-2 h-4 w-4 text-slate-500 group-hover:text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
            </svg>
        @else
            <div class="w-4 mr-2"></div>
            <svg class="mr-2 h-4 w-4 text-slate-600 group-hover:text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        @endif
        
        <span class="text-xs truncate" :class="{ 'text-slate-200 font-medium': open, 'text-slate-400': !open }">
            {{ $item['name'] }}
        </span>
    </div>

    @if($item['type'] === 'directory' && !empty($item['children']))
        <div x-show="open" x-cloak class="ml-4 pl-2 border-l border-slate-800 space-y-1 mt-1">
            @foreach($item['children'] as $child)
                @include('laranexus::partials.tree-item', ['item' => $child])
            @endforeach
        </div>
    @endif
</div>
