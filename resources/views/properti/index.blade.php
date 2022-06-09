<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Properti') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <a href="{{ route('properti.create') }}"
                    class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    + Create Properti
                </a>
            </div>
            <div class="bg-white mt-10">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            <th class="border px-6 py-4">Gambar</th>
                            <th class="border px-6 py-4">Kategori</th>
                            <th class="border px-6 py-4">Nama Properti</th>
                            <th class="border px-6 py-4">Kota</th>
                            <th class="border px-6 py-4">Pemilik</th>
                            <th class="border px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properti as $item)
                            <tr>
                                <td class="border px-6 py-4">{{ $item->id }}</td>
                                <td class="border px-6 py-4"><img
                                        src="https://{{ $item->gambar_properti }}" alt=""
                                        style="" height=100 width=100></td>
                                <td class="border px-6 py-4 ">{{ $item->kategori->nama_kategori ?? null }}</td>
                                <td class="border px-6 py-4">{{ $item->nama_properti }}</td>
                                <td class="border px-6 py-4">{{ $item->kota }}</td>
                                <td class="border px-6 py-4">{{ $item->user->name }}</td>
                                <td class="border px-6 py- text-center">
                                    <a href="{{ route('properti.show', $item->id) }}"
                                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                        Detail
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border text-center p-5">
                                    Data Tidak Ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $properti->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
