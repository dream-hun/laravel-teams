<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('New Project') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <x-notification>
                    {{ session('success') }}
                </x-notification>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($projects->isEmpty())
                        <p class="text-gray-500 text-center py-4">{{ __('No projects found.') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($projects as $project)
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h3 class="text-lg font-semibold mb-2">
                                        <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $project->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $project->description }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project->completion_percentage }}%"></div>
                                            </div>
                                            <span class="ml-2 text-sm text-gray-600">{{ number_format($project->completion_percentage, 0) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
