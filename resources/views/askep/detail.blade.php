<x-app-layout>
  <div class="flex h-screen w-full" x-data="{ modalAddPenghuni: false, modalDetailUser: false, modalEditPenghuni: false, modalGantiPassword: false }" :class="{ 'overflow-y-hidden': modalAddPenghuni || modalDetailUser || modalEditPenghuni || modalGantiPassword }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-5 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Detail Asuhan Keperawatan</h2>
        </header>
      </div>

      {{-- START: data penghuni --}}
      <div class="block flex-col rounded-md bg-white px-8 pb-8">
        <div class="flex flex-col gap-3 lg:flex-row">
          <div>
            <div class="flex h-32 w-32 place-content-center bg-gray-200">
              <img src="/photos/{{ $penghuni->foto }}" alt="" srcset="">
            </div>
          </div>
          <div class="leading-loose">
            <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
            <p>Kode Ruang : {{ $penghuni->ruang }}</p>
          </div>
          <div class="ml-auto self-end justify-self-end">
            <div class="flex">
              <a href={{ route('askep.edit', ['id_diagnosa_penghuni' => $id_diagnosa_penghuni]) }} class="mr-2 flex items-center rounded-md bg-indigo-400 px-4 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">Edit</a>
              <a href={{ route('askep.index') }} class="mr-2 flex items-center rounded-md bg-indigo-400 px-4 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">Kembali</a>
            </div>
          </div>
        </div>
      </div>
      {{-- END: data penghuni --}}

      {{-- START: Diagnosa --}}
      <div class="mt-4 block flex-col rounded-md bg-white p-8">
        <table id="table-diagnosa" class="display cell-border min-w-full">
          <thead class="bg-gray-50">
            <tr class="text-base uppercase leading-normal text-black">
              <th class="py-3 px-6 text-left font-semibold">Diagnosa</th>
              <th class="py-3 px-6 text-left font-semibold">Waktu</th>
              <th class="py-3 px-6 text-left font-semibold">Pembuat</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $data_diagnosa[0]->diagnosa }}</td>
              <td>{{ $diagnosa[0]->created_at }}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      {{-- END: Diagnosa --}}

      {{-- START: Penyebab --}}
      <div class="mt-4 block flex-col rounded-md bg-white p-8">
        <table id="table-penyebab" class="display cell-border min-w-full">
          <thead class="bg-gray-50">
            <tr class="text-base uppercase leading-normal text-black">
              <th class="py-3 px-6 text-left font-semibold">Penyebab</th>
              <th class="py-3 px-6 text-left font-semibold">Waktu</th>
              <th class="py-3 px-6 text-left font-semibold">PJ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($penyebab as $row)
              <tr>
                <td>{{ $data_penyebab[$row->id_penyebab] }}</td>
                <td>{{ $row->created_at }}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- END: Penyebab --}}

      {{-- START: Gejala --}}
      <div class="mt-4 block flex-col rounded-md bg-white p-8">
        <table id="table-gejala" class="display cell-border min-w-full">
          <thead class="bg-gray-50">
            <tr class="text-base uppercase leading-normal text-black">
              <th class="py-3 px-6 text-left font-semibold">Gejala</th>
              <th class="py-3 px-6 text-left font-semibold">Waktu</th>
              <th class="py-3 px-6 text-left font-semibold">PJ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($gejala as $row)
              <tr>
                <td>{{ $data_gejala[$row->id_gejala] }}</td>
                <td>{{ $row->created_at }}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- END: Gejala --}}

      {{-- START: Intervensi --}}
      <div class="mt-4 block flex-col rounded-md bg-white p-8">
        <table id="table-intervensi" class="display cell-border min-w-full">
          <thead class="bg-gray-50">
            <tr class="text-base uppercase leading-normal text-black">
              <th class="py-3 px-6 text-left font-semibold">Intervensi</th>
              <th class="py-3 px-6 text-left font-semibold">Waktu</th>
              <th class="py-3 px-6 text-left font-semibold">PJ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($intervensi as $row)
              <tr>
                <td>{{ $data_intervensi[$row->id_intervensi] }}</td>
                <td>{{ $row->created_at }}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- END: Intervensi --}}


      <div class="my-5">&nbsp;</div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table-diagnosa').DataTable({
        paging: false,
        searching: false,
        "info": false
      });
      $('#table-intervensi').DataTable({
        paging: false,
        searching: false,
        "info": false
      });
      $('#table-penyebab').DataTable({
        paging: false,
        searching: false,
        "info": false
      });
      $('#table-gejala').DataTable({
        paging: false,
        searching: false,
        "info": false
      });
    });
  </script>
</x-app-layout>
