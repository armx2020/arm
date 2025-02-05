@extends('admin.layouts.app')
@section('content')
    <div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-coll">
        <div class="overflow-x-auto w-full">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden">
                    <div class="relative w-full h-full md:h-auto">

                        @if (session('success'))
                            <div class="my-4 bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="bg-white rounded-lg relative">

                            <form id="appeal_delete_form" action="{{ route('admin.appeal.destroy', $appeal->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.appeal.update', ['appeal' => $appeal->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="flex justify-between p-5 border-b rounded-t">
                                    <div class="flex flex-col">
                                        <div class="flex items-center mb-4">
                                            <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $appeal->name }}
                                                ({{ $appeal->phone }})</h3>

                                        </div>

                                        @if ($appeal->entity_id)
                                            <div class="flex items-center mb-4">
                                                <h5 class="text-lg leading-none text-gray-900">
                                                    {{ $appeal->entity->name }}
                                                    (id{{ $appeal->entity->id }})</h5>
                                            </div>
                                        @endif

                                        @if ($appeal->user_id)
                                            <div class="flex items-center mb-4">
                                                <h5 class="text-lg leading-none text-gray-900">
                                                    {{ $appeal->user->firstname }}
                                                    (id{{ $appeal->user->id }})</h5>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center pl-7">
                                        <div class="pr-5">
                                            <label for="activity" class="inline-flex">
                                                <div>
                                                    <input id="activity" type="checkbox" @checked($appeal->activity)
                                                        value="1"
                                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                        name="activity">
                                                </div>
                                                <span class="ml-2 text-gray-700">Активность</span>
                                            </label>
                                        </div>
                                        <button id="appeal_delete" type="button"
                                            class="pr-5 text-gray-700">Удалить</button>
                                    </div>

                                </div>

                                <div class="p-6 space-y-6">

                                    {{-- Сообщение --}}
                                    <div class="col-span-6">
                                        <textarea type="text" name="message" id="message"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">{{ old('description', $appeal->message) }}</textarea>
                                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                    </div>

                                    <div class="items-center py-6 border-gray-200 rounded-b">
                                        <button
                                            class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                            type="submit">Сохранить</button>
                                    </div>
                                </div>


                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#appeal_delete').on("click", function() {
                $('#appeal_delete_form').submit()
            });
        });
    </script>
@endsection
