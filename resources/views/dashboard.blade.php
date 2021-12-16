<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gradebook') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <div class="flex justify-between space-x-8 mr-16 ml-16 mt-16">
        <div class="item w-96 h-32">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addSubjectModal"
                    class="bg-blue-600 rounded-md text-white w-96 h-16 font-bold shadow-2xl hover:bg-blue-700">Add
                subject
            </button>
        </div>
        <div class="item w-96 h-32">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addInstitutionModal"
                    class="p-5y bg-blue-600 rounded-md text-white w-96 h-16 font-bold shadow-2xl hover:bg-blue-700">Add
                institution
            </button>
        </div>
    </div>

    @forelse($institutions as $institution)

        <div class="flex flex-col m-16">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="text-lg font-bold ml-6 mt-3 mb-3">{{ $institution->institution }}</div>

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
                            @foreach($institution->subject as $subject)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $subject['subject'] }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="flex px-6 py-4 whitespace-nowrap">
                                        @foreach($subject->grade as $grade)
                                            <div class="text-sm text-gray-900 mr-2">{{ $grade['grade'] }}</div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-sm text-gray-900 mr-1.5">{{ $subject->getAverageGradeAttribute() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#addGradeModal"
                                           class="flex justify-end text-indigo-600 hover:text-indigo-900"
                                           data-bs-toggle="modal"><i
                                                class=""
                                                data-feather="plus"></i></a>
                                    </td>
                                </tr>
                            @endforeach
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
            <div
                class="bg-red-300 fixed bottom-0 right-0 m-6 w-1/3 p-3.5 rounded alert alert-error alert-dismissible fade show"
                role="alert">
                <lottie-player class="float-left" src="https://assets4.lottiefiles.com/packages/lf20_gzlupphk.json"
                               background="transparent" speed="1.25" style="width: 35px; height: 35px;"
                               autoplay></lottie-player>
                <p class="inline-block font-bold text-red-800 ml-3 mt-2">{{ $error }}</p>
                <button type="button" class="btn-close mr-2 mt-1" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endforeach
    @endif
    
    <!-- addSubject -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1"
         aria-labelledby="addSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font-semibold modal-title" id="addSubjectModalLabel">Add
                        subject</h5>
                </div>
                <form action="/dashboard/addSubject" method="POST">
                    <div class="modal-body">
                        @csrf
                        <label>Institution</label>
                        <select {{ $institutions->isEmpty() ? 'disabled': '' }} id="institution" name="institution"
                                placeholder="Institution"
                                class="focus:ring-indigo-500 border-indigo-500 h-10 py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md w-full">
                            @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}">{{ $institution->institution }}</option>
                            @endforeach
                        </select>

                        <label class="mt-3">Subject</label>
                        <input {{ $institutions->isEmpty() ? 'disabled': '' }} class="rounded-md w-full "
                               name="subject" type="text" placeholder="Subject">

                        <div {{ !$institutions->isEmpty() ? 'hidden': ' ' }} id="empty-institution"
                             class="mt-5 text-center text-red-800 border-2 border-red-400 bg-red-300 p-4 rounded">
                            Add a institution first. <a class="border-b-2 border-red-400" data-bs-toggle="modal"
                                                        data-bs-target="#addInstitutionModal"
                                                        data-bs-dismiss="modal" data-bs-target="#empty-institution">Click
                                here</a> to do so.
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700"
                                data-bs-dismiss="modal">Close
                        </button>
                        <button type="submit" name="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                data-bs-dismiss="modal">Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- addGrade -->
    <div class="modal fade" id="addGradeModal" tabindex="-1"
         aria-labelledby="addGradeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font-semibold modal-title" id="addGradeModalLabel">Add
                        grade</h5>
                </div>

                <form action="/dashboard/addGrade/?subject={{ $subject['id'] }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input class="rounded-md w-full" name="grade" type="number" min="0.00" max="6.00" step=".01"
                               placeholder="Grade">


                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700"
                                data-bs-dismiss="modal">Close
                        </button>
                        <button type="submit" name="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- addInstitution -->
    <div class="modal fade" id="addInstitutionModal" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font-semibold modal-title" id="addInstitutionModalLabel">Add institution</h5>
                </div>
                <form action="/dashboard/addInstitution" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input class="rounded-md w-full" name="institution_name" type="text"
                               placeholder="Institution">
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700"
                                data-bs-dismiss="modal">Close
                        </button>
                        <button type="submit" name="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                data-bs-dismiss="modal">Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>


<script>
    feather.replace()
</script>
