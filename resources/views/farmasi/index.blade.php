<x-app-layout>
  @php
    $modal_name = 'modalKonfirmasiDelete';
    $modal_header = 'Konfirmasi Hapus Obat';
  @endphp
  <div class="flex h-screen w-full"
    x-cloak x-data="{ {{ $modal_name }}: false, namaobat: null, id_obat: null }"
    :class="{ 'overflow-y-hidden': {{ $modal_name }} }">
    <!-- START: Modal Delete -->
    <x-modal :modalName=$modal_name :modalHeader=$modal_header>
      <span class="text-lg">
        Anda yakin ingin menghapus <span x-html="namaobat"></span>
        <p>
          Proses ini tidak dapat diulangi kembali!
        </p>
      </span>
      <form class="flex justify-end" action="{{ route('farmasi.proses_hapus_obat') }}" method="post">
        @csrf
        <input type="hidden" name="id_obat" x-bind:value="id_obat">
        <input type="hidden" name="namaobat" x-bind:value="namaobat">
        <button class="mr-2 flex items-center rounded-md bg-red-400 px-5 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-red-600" type="submit">Ya</button>
        <a class="mr-2 flex items-center rounded-md bg-indigo-400 px-5 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600" href="#" @click="{{ $modal_name }} = false">Batalkan</a>
      </form>
    </x-modal>
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Obat -->
      <div class="block rounded-md bg-white p-8">
        <h2 class="text-black-400 mb-3 text-3xl font-semibold leading-tight">Farmasi</h2>
        <div class="mt-2 flex">
          <a href={{ route('farmasi.tambah_transaksi') }} class="mr-2 flex items-center rounded-md bg-indigo-400 px-2 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">Tambah Transaksi Baru</a>
        </div>
        {{-- Message Banner --}}
        @if (Session::has('message'))
          <div class="my-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900" role="alert" id="message">
            {!! Session::get('message') !!}<span class="float-right"><a id="dismiss-message" href="#">x</a></span>
          </div>
        @endif
        <!-- START: Data Table -->
        <div class="mt-8 flex flex-col">
          <div>
            @if (Session::has('message_success'))
              @for ($i = 0; $i < count(Session::get('message_success')); $i++)
                <div class="mb-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900"
                  role="alert">
                  {{ Session::get('message_success')[$i] }}
                </div>
              @endfor
            @endif
          </div>
          <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden border-b border-gray-200 align-middle shadow-md">
              <table id="table-data" class="display cell-border min-w-full">
                <thead class="bg-gray-50">
                  <tr class="text-base uppercase leading-normal text-black">
                    <th class="py-3 px-6 text-left font-semibold">#</th>
                    <th class="py-3 px-6 text-left font-semibold">Nama Obat / Kode Obat</th>
                    <th class="py-3 px-6 text-left font-semibold">Jumlah Stok</th>
                    <th class="py-3 px-6 text-left font-semibold">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table-data').DataTable({
        "processing": true,
        "serverSide": true,
        "language": {
          "emptyTable": "<a href={{ route('farmasi.tambah_obat') }} class='mr-auto flex items-center rounded-md bg-green-400 p-5 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-green-600 justify-center'>Tambah Tipe Obat Baru</a>"
        },
        dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
        responsive: true,
        rowGroup: {
          dataSrc: 'nama_kode_obat',
        },
        buttons: [{
          extend: 'print',
          orientation: 'landscape',
          exportOptions: {
            columns: [0, 1, 2]
          },
          customize: function(doc) {
            $(doc.document.body).find('div')
              .css('font-size', '8pt');
          }
        }],
        "ajax": {
          "url": "{{ route('farmasi.data') }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}"
          }
        },
        columnDefs: [{
          orderable: false,
          targets: [0, 3]
        }],
        columnDefs: [{
          visible: false,
          targets: [1]
        }],
        "columns": [{
            'data': 'id'
          },
          {
            'data': 'nama_kode_obat'
          },
          {
            'data': 'stock'
          },
          {
            'data': 'action'
          }
        ],
      });
    });
  </script>
  <script>
    $("#dismiss-message").click(function() {
      $("#message").addClass('hidden duration-100');
    });
  </script>
</x-app-layout>
