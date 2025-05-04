<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <!-- タイトルをアイコンに -->
                <h2 class="text-xl font-semibold text-center text-gray-800 mb-4 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </h2>

                <!-- 検索フォーム -->
                <form method="GET" action="{{ route('history') }}" class="mb-4">
                    <div class="flex justify-center">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full max-w-4xl">
                            <div class="flex flex-col">
                                <label for="filename" class="mb-1 text-sm">ファイル名</label>
                                <input type="text" id="filename" name="filename" placeholder="ファイル名"
                                    value="{{ request('filename') }}" class="border w-full p-2 rounded">
                            </div>
                            <div class="flex flex-col">
                                <label for="start_date" class="mb-1 text-sm">開始日</label>
                                <input type="date" id="start_date" name="start_date" placeholder="開始日"
                                    value="{{ request('start_date') }}" class="border w-full p-2 rounded">
                            </div>
                            <div class="flex flex-col">
                                <label for="end_date" class="mb-1 text-sm">終了日</label>
                                <input type="date" id="end_date" name="end_date" placeholder="終了日"
                                    value="{{ request('end_date') }}" class="border w-full p-2 rounded">
                            </div>
                        </div>
                    </div>


                    <!-- ボタンの配置 -->
                    <div class="flex justify-center gap-4 mt-4">
                        <button type="submit"
                            class="flex items-center justify-center gap-1 px-4 py-2 bg-blue-500 text-white rounded">
                            　　
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            　　
                        </button>

                        <a href="{{ route('history') }}"
                            class="flex items-center justify-center gap-1 px-4 py-2 bg-gray-500 text-white rounded">
                            　　
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            　　
                        </a>
                    </div>
                </form>

                <!-- 撮影履歴一覧 -->
                <table class="w-full border text-sm text-gray-800">
                    <thead>
                        <tr>

                            <th class="border p-2 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                                </svg>

                            </th>
                            <th class="border p-2 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $image)
                            <tr>
                                <td class="border p-2 text-center">
                                    {{-- QRコードのテキストをリンクに変更 --}}
                                    <a href="{{ route('detail', ['id' => $image->id]) }}"
                                        class="text-blue-500 hover:underline">
                                        {{ $image->qr_data }}
                                    </a>
                                </td>
                                {{-- QRコード内容の列は不要になるので削除 --}}
                                {{-- <td class="border p-2 text-left">{{ $image->qr_data }}</td> --}}
                                <td class="border p-2 text-center">{{ $image->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- ページネーション -->
                <div class="mt-4">{{ $images->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>