<x-app-layout>
  {{-- ADMIN DASHBOARD <br>
    YANG LOGIN SIAPA ? <br>
    -------------------------------------------------------------------------------------------------<br>
    {{ Session::get('auth_wlha')->pluck('id')[0] }} <br>
    -------------------------------------------------------------------------------------------------<br>

    <button type="button"><a href="{{route('penghuni.tambah')}}">Tambah Penghuni</a></button>
    <button type="button"><a href="{{route('penghuni.edit')}}">Ubah Penghuni</a></button>
    <!-- <button type="button"><a href="{{route('auth.logout')}}">Logout</a></button> -->
    <div>
        @if (Session::has('message_success'))
        @for ($i = 0; $i < count(Session::get('message_success')); $i++) {{ Session::get('message_success')[$i] }} @endfor @endif </div> --}}
  <div class="flex h-screen w-full">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Penghuni -->
      <div class="block rounded-md bg-white p-8">
        <!-- START: Heading -->
        <h2 class="text-black-400 text-3xl font-semibold leading-tight">Daftar Penghuni</h2>
        <!-- START: Data Table -->
        <div class="mt-8 flex flex-col">
          <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden rounded-lg border-b border-gray-200 align-middle shadow-md">
              <table id="table-data" class="display cell-border min-w-full">
                <thead class="bg-gray-50">
                  <tr class="text-base uppercase leading-normal text-black">
                    <th class="py-3 px-6 text-left font-semibold">ID</th>
                    <th class="py-3 px-6 text-left font-semibold">Nama</th>
                    <th class="py-3 px-6 text-left font-semibold">Ruang</th>
                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                    <th class="py-3 px-6 text-left font-semibold">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- END:List Penghuni -->
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table-data').DataTable({
        "processing": true,
        "serverSide": true,
        dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
        responsive: true,
        "ajax": {
          "url": "{{ route('askep.data') }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}"
          }
        },
        buttons: {
          extend: 'print',
          text: '<i style="font-size:24px;color:#337ab7" class="fa fa fa-print fa-2x"></i>',
          exportOptions: {
            stripHtml: false
          }
        }
        columnDefs: [{
          orderable: false,
          targets: 4
        }],
        "columns": [{
            'data': 'id'
          },
          {
            'data': 'nama'
          },
          {
            'data': 'ruang'
          },
          {
            'data': 'status'
          },
          {
            'data': 'action'
          }
        ],
      });
    })
  </script>
</x-app-layout>
