@php
    $institutions = array("BMS","TBZ","Bbc");

@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    @forelse ($institutions as $institution)
        <div class="flex flex-col m-16">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="text-lg font-bold ml-6 mt-3 mb-3">{{ $institution }}</div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subject
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Grade
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Average
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Add</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            Mathematics
                                        </div>
                                    </div>
                                </td>
                                <td class="flex px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 mr-1.5">5.5</div>
                                    <div class="text-sm text-gray-900 mr-1.5">4.3</div>
                                    <div class="text-sm text-gray-900 mr-1.5">4</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 mr-1.5">4.5</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="flex justify-end text-indigo-600 hover:text-indigo-900"><i
                                            class=""
                                            data-feather="plus"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-gray-200 border-2 relative text-gray-600 py-3 px-3 rounded-lg">
            You dont have any institutions added yet!
        </div>
    @endforelse


    <div x-data="{ 'showModal': false }"
         @keydown.escape="showModal = false">
        <div class="flex items-center flex-col m-16">
            <button type="button" @click="showModal = true"
                    class="p-6 bg-blue-600 rounded-md text-white w-1/3 font-bold shadow-2xl hover:bg-blue-700">Add
                institution
            </button>
            <!-- Modal -->
            <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                 x-show="showModal">
                <!-- Modal inner -->
                <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                     @click.away="showModal = false"
                     x-transition:enter="motion-safe:ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100">
                    <!-- Title / Close-->
                    <div class="flex items-center justify-between">
                        <h5 class="mr-3 font-bold text-black max-w-none">Add institutions</h5>

                        <button type="button" class="z-50 cursor-pointer" @click="showModal = false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <!-- content -->
                    <div class="flex flex-col flex-wrap m-12">
                        <input class="rounded-md " type="text" placeholder="Institution">
                        <button
                            class="focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 rounded-md p-1.5 font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-2xl block w-80 mt-2">
                            Add
                        </button>

                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>

<script>
    feather.replace()
</script>
