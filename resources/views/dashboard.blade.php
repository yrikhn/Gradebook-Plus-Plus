<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    @forelse($institutions as $institution => $data)
        <div class="flex flex-col m-16">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="text-lg font-bold ml-6 mt-3 mb-3">{{ $data->institution }}</div>

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
                                    <a href="#addGradeModal" class="flex justify-end text-indigo-600 hover:text-indigo-900" data-bs-toggle="modal"><i
                                            class=""
                                            data-feather="plus"></i></a>


                                    <!-- Modal -->
                                    <div class="modal fade" id="addGradeModal" tabindex="-1" aria-labelledby="addGradeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="font-semibold modal-title" id="addGradeModalLabel">Add grade to {{ $data->institution }}</h5>
                                                </div>
                                                <form action="/dashboard/add" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <select id="grade" name="grade" class="focus:ring-indigo-500 border-indigo-500 h-10 py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md w-full">
                                                            <option>6</option>
                                                            <option>5</option>
                                                            <option>4</option>
                                                            <option>3</option>
                                                            <option>2</option>
                                                            <option>1</option>
                                                        </select>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit" class="px-4 py-2 text-sm font-medium text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-bs-dismiss="modal">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="m-auto mt-12 text-center bg-gray-200 w-1/4 border-2 relative text-gray-600 py-3 px-3 rounded-lg">
            You dont have any institutions added yet!
        </div>
    @endforelse

    <div class="flex items-center flex-col m-16">
        <button type="button" data-bs-toggle="modal" data-bs-target="#createInstitutionModal"
                class="p-5y bg-blue-600 rounded-md text-white w-1/4 h-16 font-bold shadow-2xl hover:bg-blue-700">Add institution
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createInstitutionModal" tabindex="-1" aria-labelledby="createInstitutionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font-semibold modal-title" id="createInstitutionModalLabel">Add institution</h5>
                </div>
                <form action="/dashboard/create" method="POST">
                <div class="modal-body">
                        @csrf
                        <input class="rounded-md w-full" name="institution_name" type="text" placeholder="Institution">
                </div>
                <div class="modal-footer">
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="px-4 py-2 text-sm font-medium text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-bs-dismiss="modal">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    @if (Session::has('message'))
        <div
            class="{{ Session::get('alert-class', 'alert-info') }} fixed bottom-0 right-0 m-6 w-1/3 p-3.5 rounded alert alert-dismissible fade show"
            role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="bg-red-500 fixed bottom-0 right-0 m-6 w-1/3 p-3.5 rounded alert alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

</x-app-layout>



<script>
    feather.replace()
</script>
