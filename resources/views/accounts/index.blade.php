<x-app-layout>
  <div class="flex h-full w-full"
    x-data="{ modalAddUser: false, modalDetailUser: false, modalEditUser: false, modalGantiPassword: false }"
    :class="{ 'overflow-y-hidden': modalAddUser || modalDetailUser || modalEditUser || modalGantiPassword }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div>
        {{-- Message Banner --}}
        @if (Session::has('message'))
          <div class="my-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900" role="alert" id="message">
            {!! Session::get('message') !!}<span class="float-right"><a id="dismiss-message" href="#">x</a></span>
          </div>
        @endif
        @if (Session::has('message_success'))
          @for ($i = 0; $i < count(Session::get('message_success')); $i++)
            <div class="mb-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900"
              role="alert">
              {{ Session::get('message_success')[$i] }}
            </div>
          @endfor
        @endif
      </div>
      <!-- START: List User -->
      <div class="block rounded-md bg-white p-8">
        <!-- START: Heading -->
        <h2 class="text-black-400 mb-3 text-3xl font-semibold leading-tight">Daftar Account</h2><br>
        <div class="flex">
          <a href="{{ route('pegawai.tambah') }}">
            <button
              class="flex items-center rounded-md bg-indigo-400 px-2 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">
              <svg class="mr-2 justify-center" width="24" height="30" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6">
                <path d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" fill="currentColor" />
              </svg>
              Tambah Pegawai
            </button>
          </a>
        </div>
        <!-- END: Heading -->
        <!-- START: Data Table -->
        <div class="mt-8 flex flex-col">
          <div class="overflow-x-auto">
            <div
              class="inline-block min-w-full overflow-hidden rounded-lg border-b border-gray-200 align-middle shadow-md">
              <table id="table-data" class="min-w-full">
                <thead class="bg-gray-50">
                  <tr class="text-base uppercase leading-normal text-black">
                    <th class="py-3 px-6 text-left font-semibold">ID</th>
                    <th class="py-3 px-6 text-left font-semibold">Username</th>
                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                    <th class="py-3 px-6 text-left font-semibold">Role</th>
                    <th class="py-3 px-6 text-left font-semibold">Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white text-base font-light text-gray-700">
                  @foreach ($accounts as $key => $acc)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                      <td class="whitespace-nowrap py-3 px-6 text-left">
                        <div class="flex items-center">
                          <span class="font-medium">{{ $key }}</span>
                        </div>
                      </td>
                      <td class="whitespace-nowrap py-3 px-6 text-left">
                        <div class="flex items-center">
                          <span class="font-semibold">{{ $acc->username }}</span>
                        </div>
                      </td>
                      <td class="whitespace-nowrap py-3 px-6 text-left">
                        <div class="flex items-center">
                          @if ($acc->status == 1)
                            <span
                              class="rounded-full bg-green-200 py-1 px-3 text-sm font-semibold text-green-700">Active</span>
                          @else
                            <span
                              class="rounded-full bg-red-200 py-1 px-3 text-sm font-semibold text-red-700">Inactive</span>
                          @endif
                        </div>
                      </td>
                      <td class="whitespace-nowrap py-3 px-6 text-left">
                        <div class="flex items-center">
                          <span class="font-medium">{{ $acc->id_level }}</span>
                        </div>
                      </td>
                      <td class="flex py-3 px-6">
                        <div class="flex items-center space-x-4">
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- END: List User -->
    </div>

    <!-- START: Modal Detail User -->
    <div class="fixed inset-0 z-20 h-full w-full overflow-y-auto bg-black bg-opacity-50 duration-300"
      x-show="modalDetailUser" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
      x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      <div class="relative mx-2 my-10 opacity-100 sm:mx-auto sm:w-3/4 md:w-1/2 lg:w-2/4"
        @click.away="modalDetailUser = false" x-show="modalDetailUser"
        x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
        x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
        x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
        <div class="relative z-20 rounded-md bg-white p-8 text-gray-900 shadow-lg">
          <header class="mb-12 flex items-center justify-between">
            <h2 class="text-xl font-semibold uppercase">Detail User</h2>
            <button class="p-2 focus:outline-none" @click="modalDetailUser = false">
              <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 18 18">
                <path
                  d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
              </svg>
            </button>
          </header>
          <div class="mb-8 flex items-center">
            {{-- <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto" src="https://randomuser.me/api/portraits/men/24.jpg" alt="User Picture"> --}}
            <img id="detailFoto" class="mx-auto h-48 w-48 rounded-full" alt="User Picture">

          </div>
          <div class="grid text-base">
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Nama Lengkap </div>
              <div class="py-2 pr-4" id="detailNama"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Username</div>
              <div class="py-2 pr-4" id="detailUsername"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Jenis Kelamin</div>
              <div class="py-2 pr-4" id="detailJenisKelamin"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Role User</div>
              <div class="py-2 pr-4" id="detailRoleUser"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Alamat</div>
              <div class="py-2 pr-4" id="detailAlamat"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Nomor Telepon</div>
              <div class="py-2 pr-4" id="detailNoTelp"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">NIK</div>
              <div class="py-2 pr-4" id="detailNIK"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Tgl Lahir</div>
              <div class="py-2 pr-4" id="detailTglLahir"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Agama</div>
              <div class="py-2 pr-4" id="detailAgama"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold" id="detailStatusUser">Status User</div>
              <div class="py-2 pr-4">
                <span class="rounded-full bg-green-200 py-1 px-3 text-sm font-semibold text-green-700"
                  id="detailActive">Active</span>
                <span class="rounded-full bg-red-200 py-1 px-3 text-sm font-semibold text-red-700"
                  id="detailInActive">Inactive</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Modal Detail User -->
  </div>

  <script>
    $(document).ready(function() {
      $('#table-data').DataTable({
        dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
        buttons: [{
          extend: 'print',
          exportOptions: {
            columns: [0, 1, 2]
          }
        }]
      });
    })
  </script>
</x-app-layout>
