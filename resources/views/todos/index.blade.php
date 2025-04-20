<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Task Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/phosphor-icons"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#F8F9FE] font-[Inter]">
    <div x-data="{ sidebarOpen: false }" class="relative min-h-screen lg:flex">
        <!-- Mobile Sidebar Toggle -->
        <div class="fixed bottom-4 right-4 z-50 lg:hidden">
            <button @click="sidebarOpen = !sidebarOpen"
                class="bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 transition-colors">
                <i class="ph-list" x-show="!sidebarOpen"></i>
                <i class="ph-x" x-show="sidebarOpen"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-white transform lg:translate-x-0 lg:static lg:inset-0 transition duration-200 ease-in-out">
            <!-- Sidebar Content -->
            <div class="h-full flex flex-col overflow-hidden">
            <div class="flex justify-start p-5">
                <img class="flex " src="https://res.cloudinary.com/dwqblckdb/image/upload/v1745118222/scdomfyr1woiohwyhrrt.png" width="150px" alt="">
            </div>

                <!-- User Profile Section in Sidebar -->
                <div class="px-4 py-3 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto p-4">
                    <!-- Tambahkan background indicator yang akan beranimasi -->
                    <div class="absolute transition-all duration-300 ease-out" x-data="{
                        activeTab: '{{ request('view', 'all') }}',
                        indicatorTop: 0,
                        init() {
                            this.$nextTick(() => this.moveIndicator());
                            this.$watch('activeTab', () => this.moveIndicator());
                        },
                        moveIndicator() {
                            const activeElement = document.querySelector(`[data-tab='${this.activeTab}']`);
                            if (activeElement) {
                                this.indicatorTop = activeElement.offsetTop;
                            }
                        }
                    }"
                        :style="`
                                                                                                                                                                                                                                                                top: ${indicatorTop}px;
                                                                                                                                                                                                                                                                height: 44px;
                                                                                                                                                                                                                                                                width: calc(100% - 8px);
                                                                                                                                                                                                                                                                left: 4px;
                                                                                                                                                                                                                                                                background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(99, 102, 241, 0.05) 100%);
                                                                                                                                                                                                                                                                border-radius: 12px;
                                                                                                                                                                                                                                                                transform-origin: left center;
                                                                                                                                                                                                                                                             `">
                    </div>

                    <!-- Navigation Links -->
                    <a href="{{ route('todos.index') }}" data-tab="all" @click="activeTab = 'all'"
                        class="relative flex items-center gap-3 px-4 py-2.5 text-sm rounded-xl transition-all duration-300 {{ !request('view') ? 'text-indigo-600 font-medium' : 'text-gray-700 hover:text-indigo-600' }}">
                        <div class="flex items-center gap-3 relative z-10">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center {{ !request('view') ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">
                                <i class="ph-house text-lg"></i>
                            </div>
                            <span>All Tasks</span>
                        </div>
                        @if (!request('view'))
                            <div
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-indigo-600">
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('todos.index', ['view' => 'important']) }}" data-tab="important"
                        @click="activeTab = 'important'"
                        class="relative flex items-center gap-3 px-4 py-2.5 text-sm rounded-xl transition-all duration-300 {{ request('view') === 'important' ? 'text-indigo-600 font-medium' : 'text-gray-700 hover:text-indigo-600' }}">
                        <div class="flex items-center gap-3 relative z-10">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center {{ request('view') === 'important' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">
                                <i class="ph-star text-lg"></i>
                            </div>
                            <span>Important</span>
                        </div>
                        @if (request('view') === 'important')
                            <div
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-indigo-600">
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('todos.index', ['view' => 'upcoming']) }}" data-tab="upcoming"
                        @click="activeTab = 'upcoming'"
                        class="relative flex items-center gap-3 px-4 py-2.5 text-sm rounded-xl transition-all duration-300 {{ request('view') === 'upcoming' ? 'text-indigo-600 font-medium' : 'text-gray-700 hover:text-indigo-600' }}">
                        <div class="flex items-center gap-3 relative z-10">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center {{ request('view') === 'upcoming' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">
                                <i class="ph-calendar text-lg"></i>
                            </div>
                            <span>Upcoming</span>
                        </div>
                        @if (request('view') === 'upcoming')
                            <div
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-indigo-600">
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('todos.index', ['view' => 'completed']) }}" data-tab="completed"
                        @click="activeTab = 'completed'"
                        class="relative flex items-center gap-3 px-4 py-2.5 text-sm rounded-xl transition-all duration-300 {{ request('view') === 'completed' ? 'text-indigo-600 font-medium' : 'text-gray-700 hover:text-indigo-600' }}">
                        <div class="flex items-center gap-3 relative z-10">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center {{ request('view') === 'completed' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">
                                <i class="ph-check-circle text-lg"></i>
                            </div>
                            <span>Completed</span>
                        </div>
                        @if (request('view') === 'completed')
                            <div
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-indigo-600">
                            </div>
                        @endif
                    </a>
                </nav>

                <!-- Logout Button at Bottom of Sidebar -->
                <div class="p-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 rounded-xl hover:bg-red-50 transition-all duration-200">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-100 text-red-600">
                                <i class="ph-sign-out text-lg"></i>
                            </div>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Mobile Header -->
            <header class="lg:hidden bg-white border-b border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-semibold text-gray-800">✨DeepList</h1>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}" class="text-gray-500">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-xs">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </a>
                        <button @click="sidebarOpen = true" class="text-gray-500">
                            <i class="ph-list text-2xl"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Desktop Header -->
            <header class="hidden lg:flex h-16 bg-white border-b border-gray-200 items-center justify-between px-8">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <form action="{{ route('todos.index') }}" method="GET" class="flex">
                            <div class="relative">
                                <i class="ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" placeholder="Search tasks..."
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 w-64 bg-gray-50 border-none rounded-l-lg focus:ring-2 focus:ring-indigo-200">
                            </div>
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700">
                                Search
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button onclick="showAddTaskModal()"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                        <i class="ph-plus"></i>
                        Add Task
                    </button>
                
                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" 
                            class="flex items-center gap-2 focus:outline-none">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-gray-700 hidden md:inline">{{ auth()->user()->name }}</span>
                            <i class="ph-caret-down text-gray-400"></i>
                        </button>
                
                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <i class="ph-user-circle"></i>
                                Profile Settings
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-50 flex items-center gap-2">
                                    <i class="ph-sign-out"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <div class="flex-1 overflow-x-hidden overflow-y-auto p-4 lg:p-8">
                <!-- Welcome Banner - Responsive -->
                <div class="bg-[#6366F1] text-white rounded-2xl p-4 lg:p-6 mb-6">
                    <h2 class="text-xl lg:text-2xl font-semibold mb-2">
                        @switch($view)
                            @case('important')
                                Important Tasks
                            @break

                            @case('upcoming')
                                Upcoming Tasks
                            @break

                            @case('completed')
                                Completed Tasks
                            @break

                            @default
                                All Tasks
                        @endswitch
                    </h2>
                    <p class="text-indigo-100">You have {{ $todos->count() }} tasks in this view</p>
                </div>

                <!-- Mobile Search -->
                <div class="mb-4 lg:hidden">
                    <form action="{{ route('todos.index') }}" method="GET" class="flex gap-2">
                        <div class="relative flex-1">
                            <i class="ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" placeholder="Search tasks..."
                                value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl">
                            <i class="ph-magnifying-glass"></i>
                        </button>
                    </form>
                </div>

                <!-- Tasks Table/List -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <!-- Desktop Table View -->
                    <table class="w-full hidden lg:table">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Task</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Due Date</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Priority</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Status</th>
                                <th class="px-6 py-4 text-right text-sm font-medium text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($todos as $todo)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="checkbox"
                                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    onChange="this.form.submit()"
                                                    {{ $todo->is_completed ? 'checked' : '' }}>
                                            </form>
                                            <div>
                                                <h3
                                                    class="font-medium text-gray-900 {{ $todo->is_completed ? 'line-through text-gray-500' : '' }}">
                                                    {{ $todo->title }}
                                                </h3>
                                                <p class="text-sm text-gray-500">
                                                    {{ Str::limit($todo->description, 50) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-500">
                                            {{ $todo->due_date->format('M d, H:i') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @switch($todo->priority)
                                            @case('high')
                                                <span
                                                    class="px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-medium">High</span>
                                            @break

                                            @case('medium')
                                                <span
                                                    class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-medium">Medium</span>
                                            @break

                                            @default
                                                <span
                                                    class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium">Low</span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 {{ $todo->is_completed ? 'bg-green-50 text-green-700' : 'bg-blue-50 text-blue-700' }} rounded-full text-xs font-medium">
                                            {{ $todo->is_completed ? 'Completed' : 'Active' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button onclick="editTodo({{ $todo->id }})"
                                                class="p-1 text-gray-400 hover:text-gray-600">
                                                <i class="ph-pencil-simple text-lg"></i>
                                            </button>
                                            <button onclick="showDeleteModal({{ $todo->id }})"
                                                class="p-1 text-gray-400 hover:text-gray-600">
                                                <i class="ph-trash text-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center">
                                            <div class="flex flex-col items-center">
                                                <i class="ph-clipboard-text text-4xl text-gray-400 mb-2"></i>
                                                <p class="text-gray-500">No tasks found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Mobile List View -->
                        <div class="lg:hidden divide-y divide-gray-100">
                            @forelse($todos as $todo)
                                <div class="p-4">
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="flex items-start gap-3">
                                            <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="checkbox"
                                                    class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    onChange="this.form.submit()"
                                                    {{ $todo->is_completed ? 'checked' : '' }}>
                                            </form>
                                            <div>
                                                <h3
                                                    class="font-medium text-gray-900 {{ $todo->is_completed ? 'line-through text-gray-500' : '' }}">
                                                    {{ $todo->title }}
                                                </h3>
                                                <p class="text-sm text-gray-500 mt-1">{{ $todo->description }}</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <button onclick="editTodo({{ $todo->id }})"
                                                class="p-1 text-gray-400 hover:text-gray-600">
                                                <i class="ph-pencil-simple"></i>
                                            </button>
                                            <button onclick="showDeleteModal({{ $todo->id }})"
                                                class="p-1 text-gray-400 hover:text-gray-600">
                                                <i class="ph-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between text-sm mt-3">
                                        <div class="flex items-center gap-2 text-gray-500">
                                            <i class="ph-clock"></i>
                                            {{ $todo->due_date->format('M d, H:i') }}
                                        </div>
                                        @switch($todo->priority)
                                            @case('high')
                                                <span
                                                    class="px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-medium">High</span>
                                            @break

                                            @case('medium')
                                                <span
                                                    class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-medium">Medium</span>
                                            @break

                                            @default
                                                <span
                                                    class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium">Low</span>
                                        @endswitch
                                    </div>
                                </div>
                                @empty
                                    <div class="p-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="ph-clipboard-text text-4xl text-gray-400 mb-2"></i>
                                            <p class="text-gray-500">No tasks found</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Add Task Button -->
                    <button onclick="showAddTaskModal()"
                        class="fixed bottom-20 right-4 z-40 lg:hidden bg-indigo-600 text-white p-4 rounded-full shadow-lg hover:bg-indigo-700">
                        <i class="ph-plus text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Edit Modal -->
            <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                <div class="relative top-20 mx-auto p-5 w-full max-w-2xl">
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-semibold text-gray-800">Edit Task</h3>
                            <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                                <i class="ph-x-circle text-2xl"></i>
                            </button>
                        </div>

                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Task Title</label>
                                    <input type="text" name="title" id="editTitle" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Priority Level</label>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" @click.away="open = false" type="button"
                                            class="w-full bg-white px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div id="editSelectedPriorityDot" class="w-3 h-3 rounded-full bg-emerald-500">
                                                </div>
                                                <span id="editSelectedPriorityText" class="text-gray-700">Low Priority</span>
                                            </div>
                                            <i class="ph-caret-down text-gray-400 transition-transform"
                                                :class="{ 'transform rotate-180': open }"></i>
                                        </button>

                                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                                            x-transition:enter-end="opacity-100 transform translate-y-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 transform translate-y-0"
                                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                                            class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-lg border border-gray-100 py-2">

                                            <input type="hidden" name="priority" id="editPriorityInput" value="low">

                                            <div class="priority-option cursor-pointer hover:bg-gray-50 px-4 py-2 flex items-center gap-3"
                                                onclick="selectEditPriority('low')">
                                                <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                                                <span class="text-gray-700">Low Priority</span>
                                            </div>

                                            <div class="priority-option cursor-pointer hover:bg-gray-50 px-4 py-2 flex items-center gap-3"
                                                onclick="selectEditPriority('medium')">
                                                <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                                <span class="text-gray-700">Medium Priority</span>
                                            </div>

                                            <div class="priority-option cursor-pointer hover:bg-gray-50 px-4 py-2 flex items-center gap-3"
                                                onclick="selectEditPriority('high')">
                                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                                <span class="text-gray-700">High Priority</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Due Date & Time</label>
                                    <input type="text" name="due_date" id="editDueDate" required
                                        class="editDatepicker w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="editDescription"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all"></textarea>
                                </div>
                            </div>
                            <div class="flex justify-end gap-3 mt-6">
                                <button type="button" onclick="closeEditModal()"
                                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl hover:opacity-90 transition-all duration-200">
                                    Update Task
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tambahkan modal konfirmasi delete sebelum tag penutup body -->
            <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full"
                style="z-index: 999;">
                <div class="relative top-20 mx-auto p-5 w-full max-w-md">
                    <div class="bg-white rounded-2xl shadow-xl p-6 transform transition-all duration-300 scale-100">
                        <div class="text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                                <i class="ph-warning-circle text-2xl text-red-600"></i>
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">Delete Task</h3>
                            <p class="text-sm text-gray-500 mb-6">
                                Are you sure you want to delete this task? This action cannot be undone.
                            </p>
                        </div>
                        <form id="deleteForm" method="POST" class="mt-2 flex justify-center gap-3">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="closeDeleteModal()"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 flex items-center gap-2">
                                <i class="ph-trash"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update modal Add Task -->
            <div id="addTaskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden" style="z-index: 50;">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-2xl w-full max-w-xl overflow-hidden" style="max-height: 90vh;">
                        <!-- Modal Header with Gradient -->
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                                    <i class="ph-plus-circle"></i>
                                    Create New Task
                                </h3>
                                <button onclick="hideAddTaskModal()" class="text-white/80 hover:text-white transition-colors">
                                    <i class="ph-x text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="overflow-y-auto" style="max-height: calc(90vh - 60px);">
                            <form action="{{ route('todos.store') }}" method="POST" class="p-8">
                                @csrf
                                <div class="space-y-6">
                                    <!-- Title Input -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Task Title</label>
                                        <div class="relative">
                                            <input type="text" name="title" required
                                                placeholder="What needs to be done?"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all">
                                            <i class="ph-notepad absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                        </div>
                                    </div>

                                    <!-- Description Input -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                        <div class="relative">
                                            <textarea name="description" rows="4" placeholder="Add more details to this task..."
                                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all"></textarea>
                                            <i class="ph-text-align-left absolute left-3 top-3 text-gray-400"></i>
                                        </div>
                                    </div>

                                    <!-- Due Date and Priority in Grid dengan spacing yang lebih besar -->
                                    <div class="grid grid-cols-2 gap-6">
                                        <!-- Due Date Input -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                                            <div class="relative">
                                                <input type="text" name="due_date" required
                                                    placeholder="Select date & time"
                                                    class="datepicker w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all">
                                                <i
                                                    class="ph-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                            </div>
                                        </div>

                                        <!-- Priority Selection dengan z-index yang lebih tinggi -->
                                        <div class="relative" style="z-index: 60;">
                                            <!-- Priority dropdown content tetap sama -->
                                            <div x-data="{ open: false, selected: 'low' }">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                                                <div class="relative">
                                                    <input type="hidden" name="priority" x-model="selected">
                                                    <button @click="open = !open" @click.away="open = false" type="button"
                                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all text-left flex items-center justify-between">
                                                        <div class="flex items-center gap-2">
                                                            <i class="ph-flag absolute left-3 text-gray-400"></i>
                                                            <div class="flex items-center gap-2">
                                                                <div x-show="selected === 'low'"
                                                                    class="w-2 h-2 rounded-full bg-emerald-500">
                                                                </div>
                                                                <div x-show="selected === 'medium'"
                                                                    class="w-2 h-2 rounded-full bg-amber-500">
                                                                </div>
                                                                <div x-show="selected === 'high'"
                                                                    class="w-2 h-2 rounded-full bg-red-500">
                                                                </div>
                                                                <span
                                                                    x-text="selected === 'low' ? 'Low Priority' : selected === 'medium' ? 'Medium Priority' : 'High Priority'"
                                                                    class="text-gray-700">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <i class="ph-caret-down text-gray-400 transition-transform duration-200"
                                                            :class="{ 'transform rotate-180': open }">
                                                        </i>
                                                    </button>

                                                    <!-- Dropdown Menu -->
                                                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                                        x-transition:leave="transition ease-in duration-150"
                                                        x-transition:leave-start="opacity-100 transform translate-y-0"
                                                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                                                        class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-lg border border-gray-100 py-2"
                                                        style="display: none;">

                                                        <!-- Low Priority Option -->
                                                        <button type="button" @click="selected = 'low'; open = false"
                                                            class="w-full px-4 py-2.5 text-left hover:bg-gray-50 flex items-center gap-3 transition-colors"
                                                            :class="{ 'bg-indigo-50': selected === 'low' }">
                                                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                                            <span class="text-gray-700">Low Priority</span>
                                                            <i class="ph-check text-indigo-600 ml-auto"
                                                                x-show="selected === 'low'"></i>
                                                        </button>

                                                        <!-- Medium Priority Option -->
                                                        <button type="button" @click="selected = 'medium'; open = false"
                                                            class="w-full px-4 py-2.5 text-left hover:bg-gray-50 flex items-center gap-3 transition-colors"
                                                            :class="{ 'bg-indigo-50': selected === 'medium' }">
                                                            <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                                            <span class="text-gray-700">Medium Priority</span>
                                                            <i class="ph-check text-indigo-600 ml-auto"
                                                                x-show="selected === 'medium'"></i>
                                                        </button>

                                                        <!-- High Priority Option -->
                                                        <button type="button" @click="selected = 'high'; open = false"
                                                            class="w-full px-4 py-2.5 text-left hover:bg-gray-50 flex items-center gap-3 transition-colors"
                                                            :class="{ 'bg-indigo-50': selected === 'high' }">
                                                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                                            <span class="text-gray-700">High Priority</span>
                                                            <i class="ph-check text-indigo-600 ml-auto"
                                                                x-show="selected === 'high'"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons dengan margin top yang lebih besar -->
                                    <div class="flex items-center justify-end gap-3 pt-6">
                                        <button type="button" onclick="hideAddTaskModal()"
                                            class="px-6 py-2.5 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-200 flex items-center gap-2">
                                            <i class="ph-x"></i>
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:opacity-90 transition-all duration-200 flex items-center gap-2">
                                            <i class="ph-check-circle"></i>
                                            Create Task
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Initialize flatpickr with custom styling
                    flatpickr(".datepicker", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        minDate: "today",
                        time_24hr: true,
                        // Tambahkan theme yang lebih modern
                        theme: "light",
                        // Animate the calendar
                        animate: true
                    });

                    // Initialize flatpickr for edit modal
                    flatpickr(".editDatepicker", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        time_24hr: true
                    });
                });

                function editTodo(id) {
                    // Ambil data todo menggunakan fetch
                    fetch(`/todos/${id}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('editTitle').value = data.title;
                            document.getElementById('editDescription').value = data.description;
                            document.getElementById('editSelectedPriorityText').textContent = data.priority;
                            document.getElementById('editDueDate')._flatpickr.setDate(data.due_date);

                            // Set action URL untuk form
                            document.getElementById('editForm').action = `/todos/${id}`;

                            // Tampilkan modal
                            document.getElementById('editModal').classList.remove('hidden');
                        });
                }

                function closeEditModal() {
                    document.getElementById('editModal').classList.add('hidden');
                }

                // Close modal when clicking outside
                document.getElementById('editModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeEditModal();
                    }
                });

                function selectPriority(value) {
                    const dot = document.getElementById('selectedPriorityDot');
                    const text = document.getElementById('selectedPriorityText');
                    const input = document.getElementById('priorityInput');

                    input.value = value;

                    switch (value) {
                        case 'high':
                            dot.className = 'w-3 h-3 rounded-full bg-red-500';
                            text.textContent = 'High Priority';
                            break;
                        case 'medium':
                            dot.className = 'w-3 h-3 rounded-full bg-amber-500';
                            text.textContent = 'Medium Priority';
                            break;
                        case 'low':
                            dot.className = 'w-3 h-3 rounded-full bg-emerald-500';
                            text.textContent = 'Low Priority';
                            break;
                    }
                }

                function selectEditPriority(value) {
                    const dot = document.getElementById('editSelectedPriorityDot');
                    const text = document.getElementById('editSelectedPriorityText');
                    const input = document.getElementById('editPriorityInput');

                    input.value = value;

                    switch (value) {
                        case 'high':
                            dot.className = 'w-3 h-3 rounded-full bg-red-500';
                            text.textContent = 'High Priority';
                            break;
                        case 'medium':
                            dot.className = 'w-3 h-3 rounded-full bg-amber-500';
                            text.textContent = 'Medium Priority';
                            break;
                        case 'low':
                            dot.className = 'w-3 h-3 rounded-full bg-emerald-500';
                            text.textContent = 'Low Priority';
                            break;
                    }
                }

                function showDeleteModal(todoId) {
                    const modal = document.getElementById('deleteModal');
                    const form = document.getElementById('deleteForm');

                    // Set action URL untuk form delete
                    form.action = `/todos/${todoId}`;

                    // Tampilkan modal dengan animasi
                    modal.classList.remove('hidden');
                    const modalContent = modal.querySelector('.scale-100');
                    modalContent.classList.add('scale-95');
                    setTimeout(() => {
                        modalContent.classList.remove('scale-95');
                        modalContent.classList.add('scale-100');
                    }, 10);
                }

                function closeDeleteModal() {
                    const modal = document.getElementById('deleteModal');
                    const modalContent = modal.querySelector('.scale-100');

                    // Animasi menutup
                    modalContent.classList.remove('scale-100');
                    modalContent.classList.add('scale-95');

                    setTimeout(() => {
                        modal.classList.add('hidden');
                        modalContent.classList.remove('scale-95');
                        modalContent.classList.add('scale-100');
                    }, 200);
                }

                // Close modal when clicking outside
                document.getElementById('deleteModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeDeleteModal();
                    }
                });

                function showAddTaskModal() {
                    document.getElementById('addTaskModal').classList.remove('hidden');
                }

                function hideAddTaskModal() {
                    document.getElementById('addTaskModal').classList.add('hidden');
                }
            </script>
            </div>
        </body>

        </html>
