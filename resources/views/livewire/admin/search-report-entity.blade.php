<div>
    <div class="py-6 px-4 max-w-7xl mx-auto rounded-t-lg">
        <x-admin.alert />

        <div class="p-4 bg-white block shadow sm:flex items-center justify-between border-b border-gray-200">
            <div class="my-3 w-full">
                <div class="flex flex-row justify-between">
                    <div class="mb-4 flex space-x-1">
                        <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">
                            {{ $title }}
                        </h1>
                    </div>
                    <div class="flex items-center space-x-1 lg:space-x-2">
                        <div
                           class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-2 py-1 lg:px-3 lg:py-2 text-center sm:w-auto">

                            <a class="ml-1 mr-3" href="{{ route('admin.entity.report', ['month' => $prevMonth, 'year' => $prevYear]) }}">
                                <svg height="12" viewBox="0 0 145 244" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M129.456 242.935C137.216 240.523 143.702 231.803 144.664 222.487C145.682 212.622 145.196 212.018 98.293 164.861L55.577 121.915L99.117 78.1796C139.621 37.4925 142.736 34.1166 143.806 29.7506C145.442 23.0746 145.207 19.0936 142.872 13.9436C140.13 7.89556 137.414 5.13056 131.456 2.32056C125.099 -0.676443 118.312 -0.774439 112.666 2.04956C109.886 3.44156 90.731 21.8676 56.267 56.3056C0.844997 111.684 0 112.67 0 121.944C0 131.194 0.993 132.364 53.761 185.244C81.093 212.634 105.87 236.916 108.82 239.204C113.619 242.925 114.832 243.39 120.32 243.615C123.695 243.754 127.806 243.447 129.456 242.935Z" fill="white"/>
                                </svg>
                            </a>
                            {{ $month }}
                            <a class="ml-3 mr-1" href="{{ route('admin.entity.report', ['month' => $nextMonth, 'year' => $nextYear]) }}">
                                <svg height="12" viewBox="0 0 145 244" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.4319 0.713465C7.67191 3.12547 1.18591 11.8455 0.223909 21.1615C-0.794091 31.0265 -0.308094 31.6305 46.5949 78.7875L89.3109 121.733L45.7709 165.468C5.26691 206.155 2.15191 209.531 1.08191 213.897C-0.554091 220.573 -0.319091 224.554 2.01591 229.704C4.75791 235.752 7.47391 238.517 13.4319 241.327C19.7889 244.324 26.5759 244.422 32.2219 241.598C35.0019 240.206 54.1569 221.78 88.6209 187.342C144.043 131.964 144.888 130.978 144.888 121.704C144.888 112.454 143.895 111.284 91.1269 58.4045C63.7949 31.0145 39.0179 6.73247 36.0679 4.44447C31.2689 0.723465 30.0559 0.258465 24.5679 0.0334654C21.1929 -0.105535 17.0819 0.201465 15.4319 0.713465Z" fill="white"/>
                                </svg>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div wire:loading class="w-full">
            <div class="bg-white shadow p-4">
                <div class="flex items-center text-center justify-center">
                    <img class="h-5 w-5 rounded-full m-4" src="{{ url('/image/loading.gif') }}">
                    LOADING
                </div>
            </div>
        </div>
        <div wire:loading.remove>
            <div class="mb-4 flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden">
                                <table class="table-fixed min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-200">
                                    <tr>
                                        <th scope="col" class="pl-4 text-left text-gray-500">Регион</th>
                                        @foreach ($entityTypes as $type)
                                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 max-w-[20rem] truncate">
                                                {{ $type->name }}
                                            </th>
                                        @endforeach

                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($table as $row)
                                        <tr class="hover:bg-gray-200">
                                            <td class="pl-4 text-xs">{{ $row['region'] }}</td>
                                            @foreach ($entityTypes as $type)
                                                <td class="p-4 text-base text-left break-all max-w-[20rem] truncate">
                                                    {{ $row[$type->name] }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

</div>
