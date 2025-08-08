@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Proximity Check History</h1>
                    <p class="mt-2 text-gray-600">Track location-based proximity checks and their results</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $logs->total() }} Total Records
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsive Table -->
        <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Radius</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Distance</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checked At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50 divide-y divide-gray-200">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-3 sm:px-6 py-4">
                                    <div class="text-xs sm:text-sm font-mono text-gray-900">
                                        <div class="hidden sm:block">{{ number_format($log->latitude, 6) }}, {{ number_format($log->longitude, 6) }}</div>
                                        <div class="sm:hidden">
                                            <div>{{ number_format($log->latitude, 4) }}</div>
                                            <div>{{ number_format($log->longitude, 4) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm text-gray-900 font-medium">{{ number_format($log->radius) }}m</div>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm text-gray-900 font-medium">{{ number_format($log->distance, 1) }}m</div>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    @if($log->within_range)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <div class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1 sm:mr-1.5"></div>
                                            <span class="hidden sm:inline">Within Range</span>
                                            <span class="sm:hidden">In</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <div class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1 sm:mr-1.5"></div>
                                            <span class="hidden sm:inline">Out of Range</span>
                                            <span class="sm:hidden">Out</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm text-gray-900">{{ $log->created_at->format('M j, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $log->created_at->format('H:i:s') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="w-12 sm:w-16 h-12 sm:h-16 mx-auto mb-4 text-gray-300">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">No proximity logs found</h3>
                                    <p class="text-sm text-gray-500">Proximity checks will appear here once they're recorded.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
            <div class="mt-6">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>

<style>
/* Custom pagination styles */
.pagination {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 0.25rem;
    flex-wrap: wrap;
    justify-content: center;
}

.page-item {
    display: flex;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 0.75rem;
    text-decoration: none;
    color: #6b7280;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    transition: all 0.15s ease-in-out;
    font-size: 0.875rem;
    min-width: 2.5rem;
    height: 2.5rem;
}

.page-link:hover {
    background-color: #f9fafb;
    color: #374151;
    border-color: #9ca3af;
}

.page-item.active .page-link {
    background-color: #3b82f6;
    color: white;
    border-color: #3b82f6;
}

.page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Small screen adjustments */
@media (max-width: 640px) {
    .page-link {
        padding: 0.375rem 0.5rem;
        min-width: 2rem;
        height: 2rem;
        font-size: 0.75rem;
    }
}
</style>
@endsection