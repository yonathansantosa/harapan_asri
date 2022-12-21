<x-app-layout>
  <div class="flex h-screen w-full">
    <div class="w-full flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Penghuni -->
      <div class="block w-full rounded-md bg-white p-8">
        <!-- START: Heading -->
        <h2 class="text-black-400 w-full text-3xl font-semibold leading-tight">Daftar Asuhan Keperawatan</h2>
        <!-- START: Data Table -->
        <a href="{{ route('askep.tambah') }}" class="mr-auto">
          <button class="mt-5 flex items-center rounded-md bg-indigo-400 px-4 py-2 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">
            <svg class="mr-2 justify-center" width="24" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6">
              <path d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
              C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
              C15.952,9,16,9.447,16,10z" fill="currentColor" />
            </svg>
            Tambah Data Asuhan
          </button>
        </a>
        <div class="mt-8 flex w-full flex-col">
          <div class="w-full">
            <div class="inline-block w-full max-w-full overflow-auto border-gray-200 align-middle">
              <table id="table-data" class="display cell-border cell-align-top w-full" width="100%">
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

        buttons: [{
          extend: 'print',
          orientation: 'landscape',
          pageSize: 'A4',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6],
            stripHtml: false,
          },
          title: "Asuhan Keperawatan",
          customize: function(win) {
            var fontSize = '9pt';
            $(win.document.body)
              .css('font-size', fontSize);
            $(win.document.body).find('table')
              .css('font-size', fontSize);
            $(win.document.body).find('td')
              .css('font-size', fontSize);
            $(win.document.body).find('td')
              .css('padding', '2pt');
            $(win.document.body).find('td')
              .css('line-height', 'normal');
            $(win.document.body).find('li')
              .css('line-height', 'normal');
          }
        }],
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
