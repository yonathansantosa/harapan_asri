<x-app-layout>
  <div class="flex h-screen w-full">
    <div class="w-full flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Penghuni -->
      <div class="block w-full rounded-md bg-white p-8">
        <!-- START: Heading -->
        <h2 class="text-black-400 w-full text-3xl font-semibold leading-tight">Daftar Asuhan Keperawatan</h2>
        <!-- START: Data Table -->
        <div class="mt-8 flex w-full flex-col">
          <div class="w-full">
            <div class="inline-block max-w-full overflow-auto border-gray-200 align-middle">
              <table id="table-data" class="display cell-border nowrap w-full" width="100%">
                <thead class="bg-gray-50">
                  <tr class="text-base uppercase leading-normal text-black">
                    <th class="py-3 px-6 text-left font-semibold">#</th>
                    <th class="py-3 px-6 text-left font-semibold">Penghuni</th>
                    <th class="py-3 px-6 text-left font-semibold">Timestamp</th>
                    <th class="py-3 px-6 text-left font-semibold">Diagnosa</th>
                    <th class="py-3 px-6 text-left font-semibold">Gejala</th>
                    <th class="py-3 px-6 text-left font-semibold">Penyebab</th>
                    <th class="py-3 px-6 text-left font-semibold">Intervensi</th>
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
      var resp = false;
      var scroll = true;
      if ($(window).width() < 768) {
        resp = true;
        // scroll = false;
      };
      $('#table-data').DataTable({
        "processing": true,
        "serverSide": true,
        dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
        responsive: resp,
        fixedColumns: {
          right: 1
        },
        scrollX: scroll,
        "ajax": {
          "url": "{{ route('askep.data_askep_penghuni') }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}",
          }
        },
        columnDefs: [{
          orderable: false,
          targets: [0, 4, 5, 6, 7]
        }],
        "columns": [{
            'data': 'id'
          },
          {
            'data': 'penghuni'
          },
          {
            'data': 'timestamp'
          },
          {
            'data': 'diagnosa'
          },
          {
            'data': 'gejala'
          },
          {
            'data': 'penyebab'
          },
          {
            'data': 'intervensi'
          },
          {
            'data': 'action'
          },
        ],
      });
    })
  </script>
</x-app-layout>
