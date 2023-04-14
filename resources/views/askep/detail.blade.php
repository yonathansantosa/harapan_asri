<x-app-layout>
  <div class="flex h-screen w-full pb-16">
    <div class="w-full flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Penghuni -->
      <div class="block w-full rounded-md bg-white p-8">
        {{-- START: data penghuni --}}
        <div class="mt-4 block flex-col rounded-md bg-white">
          <div class="flex flex-col gap-3 lg:flex-row">
            <div>
              <div class="flex h-48 w-48 place-content-center bg-gray-200">
                <img src="/photos/{{ $penghuni->foto }}" alt="" srcset="">
              </div>
            </div>
            <div class="ml-5 w-full leading-loose">
              <p class="mb-4 text-3xl font-semibold leading-tight">Detail Asuhan Keperawatan</p>
              <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
              {{-- {{dd($diagnosa)}} --}}
              <p class="text-xl"><span class="font-bold">Diagnosa : </span>{{ $data_diagnosa[0]->diagnosa }}</p>
              <p class="text-xl"><span class="font-bold">Waktu : </span>{{ $diagnosa[0]->created_at }}</p>
              <p class="text-xl"><span class="font-bold">Pembuat : </span>Admin</p>
              <div class="text mt-4 flex justify-end">
                <a href="{{ route('askep.index') }}" class="mr-5 rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50">
                  Kembali
                </a>
                <a href="{{ route('askep.edit', ['id_diagnosa_penghuni' => $diagnosa[0]->id]) }}" class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50">
                  Edit / Tambah Perkembangan
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- END: data penghuni --}}
      <div class="mt-8 mb-16 block w-full rounded-md bg-white p-8">
        {{-- {{dd($gejala)}} --}}
        <table class="mb-16 min-w-full text-xl" id="table-gejala">
          @if (!$gejala->isEmpty())
            {{-- START: data gejala --}}
            <tr class="text-2xl font-bold">
              <td class="border-b border-gray-400">Gejala</td>
              <td class="border-b border-gray-400"></td>
              <td class="border-b border-gray-400"></td>
            </tr>
            {{-- {{ dd($pegawai) }} --}}
            @foreach ($gejala as $row)
              {{-- {{ dd($row->id_pegawai) }} --}}
              {{-- {{ dd($pegawai->where('id', $row->id_pegawai)) }} --}}
              <tr>
                <td class="border-b border-gray-400">{{ $row->created_at }}</td>
                <td class="border-b border-gray-400">{{ $pegawai->where('id', $row->id_pegawai)->pluck('nama')[0] }}</td>
                <td class="border-b border-gray-400">{{ $data_gejala[$row->id_gejala] }}</td>
              </tr>
            @endforeach
            {{-- END: data gejala --}}
          @endif
          @if (!$penyebab->isEmpty())
            {{-- START: data penyebab --}}
            <tr class="text-2xl font-bold">
              <td class="border-b border-gray-400">Penyebab</td>
              <td class="border-b border-gray-400"></td>
              <td class="border-b border-gray-400"></td>
            </tr>
            @foreach ($penyebab as $row)
              <tr>
                <td class="border-b border-gray-400">{{ $row->created_at }}</td>
                <td class="border-b border-gray-400">{{ $pegawai->where('id', $row->id_pegawai)->pluck('nama')[0] }}</td>
                <td class="border-b border-gray-400">{{ $data_penyebab[$row->id_penyebab] }}</td>
              </tr>
            @endforeach
            {{-- END: data penyebab --}}
          @endif
          @if (!$intervensi->isEmpty())
            {{-- START: data intervensi --}}
            <tr class="text-2xl font-bold">
              <td class="border-b border-gray-400">Intervensi</td>
              <td class="border-b border-gray-400"></td>
              <td class="border-b border-gray-400"></td>
            </tr>
            @foreach ($intervensi as $row)
              <tr>
                <td class="border-b border-gray-400">{{ $row->created_at }}</td>
                <td class="border-b border-gray-400">{{ $pegawai->where('id', $row->id_pegawai)->pluck('nama')[0] }}</td>
                <td class="border-b border-gray-400">{{ $data_intervensi[$row->id_intervensi] }}</td>
              </tr>
            @endforeach
            {{-- END: data intervensi --}}
          @endif
          @if (!$implementasi->isEmpty())
            {{-- START: data implementasi --}}
            <tr class="text-2xl font-bold">
              <td class="border-b border-gray-400">Implementasi</td>
              <td class="border-b border-gray-400"></td>
              <td class="border-b border-gray-400"></td>
            </tr>
            @foreach ($implementasi as $row)
              <tr>
                <td class="border-b border-gray-400">{{ $row->created_at }}</td>
                <td class="border-b border-gray-400">{{ $pegawai->where('id', $row->id_pegawai)->pluck('nama')[0] }}</td>
                <td class="border-b border-gray-400">{{ $data_implementasi[$row->id_implementasi] }}</td>
              </tr>
            @endforeach
            {{-- END: data implementasi --}}
          @endif
        </table>
      </div>
      <div class="mb-16">
        &nbsp;
      </div>
    </div>
    {{-- END: data intervensi --}}
  </div>
  <script>
    $(document).ready(function() {
      $('#table-gejala').DataTable();
    });
  </script>
</x-app-layout>
