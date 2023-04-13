<x-app-layout>
  <div class="flex h-screen w-full">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-12 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Tambah User</h2>
        </header>
        @if (count($errors) > 0)
          <div class="mb-4 rounded-md border border-red-200 bg-red-100 py-3 px-5 text-sm text-red-900"
               role="alert">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form method="POST" action="{{ route('pegawai.prosestambah') }}"
              enctype="multipart/form-data">
          @csrf

          <!-- nama Input -->
          <x-label for="nama" :value="__('Nama Lengkap')" required :invalid="$errors->has('nama')" />
          <x-input id="nama" type="text" name="nama" :value="old('nama')" :invalid="$errors->has('nama')"
                   placeholder="Masukkan Nama Lengkap" autocomplete="off" />
          @if (Session::has('error_update.nama'))
            {{ Session::get('error_update.nama') }}
            <br>
          @endif

          <!-- NIK Input -->
          <x-label for="nik" :value="__('NIK (Sesuai KTP)')" required :invalid="$errors->has('nik')" />
          <x-input id="nik" type="text" name="nik" :value="old('nik')" placeholder="Masukkan NIK" :invalid="$errors->has('nik')"
                   autocomplete="off" />
          @if (Session::has('error_tambah.nik'))
            {{ Session::get('error_tambah.nik') }}
            <br>
          @endif

          <!-- Tgl Lahir Input -->
          <x-label for="tgl_lahir" :value="__('Tanggal Lahir')" required :invalid="$errors->has('tgl_lahir')" />
          <x-input id="tgl_lahir" type="date" name="tgl_lahir" :value="old('tgl_lahir')" :invalid="$errors->has('tgl_lahir')"
                   autocomplete="off" />
          @if (Session::has('error_tambah.tgl_lahir'))
            {{ Session::get('error_tambah.tgl_lahir') }}
            <br>
          @endif

          <!-- Jenis kelamin Input -->
          <x-label for="gender" :value="__('Jenis Kelamin')" required :invalid="$errors->has('gender')" />
          <div class="flex">
            @foreach (['pria', 'wanita'] as $gender)
              <x-label for="{{ $gender }}" class="flex cursor-pointer p-2" :invalid="$errors->has('gender')">
                <input class="my-auto scale-125 transform" type="radio" id="{{ $gender }}" name="gender"
                       value="{{ $gender }}" checked="{{ old('gender') == $gender ? 'checked' : null }}" />
                <div class="px-2">{{ ucfirst($gender) }}</div>
              </x-label>
            @endforeach
          </div>
          @if (Session::has('error_tambah.gender'))
            {{ Session::get('error_tambah.gender') }}
            <br>
          @endif

          <!-- Agama Input -->
          <x-label for="agama" :value="__('Agama')" required :invalid="$errors->has('agama')" />
          <div class="flex flex-wrap">
            @foreach (['katolik', 'kristen', 'islam', 'hindu', 'budha', 'khonghucu', 'kepercayaan'] as $agama)
              <x-label for="{{ $agama }}" class="flex cursor-pointer p-2" :invalid="$errors->has('agama')">
                <input class="my-auto scale-125 transform" type="radio" id="{{ $agama }}" name="agama"
                       checked="{{ old('agama') == $agama }}" value="{{ $agama }}" />
                <div class="px-2">{{ ucfirst($agama) }}</div>
              </x-label>
            @endforeach
          </div>
          @if (Session::has('error_tambah.agama'))
            {{ Session::get('error_tambah.agama') }}
            <br>
          @endif

          <!-- Alamat Input -->
          <x-label for="alamat" :value="__('Alamat')" required :invalid="$errors->has('alamat')" />
          <x-input id="alamat" type="text" name="alamat" :value="old('alamat')" :invalid="$errors->has('alamat')"
                   placeholder="Masukkan Alamat Anda" autocomplete="off" />
          @if (Session::has('error_tambah.alamat'))
            {{ Session::get('error_tambah.alamat') }}
            <br>
          @endif

          <!-- Nomor Telepon Input -->
          <x-label for="notelp" :value="__('Nomor Telepon')" required :invalid="$errors->has('notelp')" />
          <x-input class="appearance-none" id="notelp" type="number" name="notelp" :value="old('notelp')" :invalid="$errors->has('notelp')"
                   placeholder="Masukkan Nomor Telepon Anda" autocomplete="off" />
          @if (Session::has('error_tambah.notelp'))
            {{ Session::get('error_tambah.notelp') }}
            <br>
          @endif

          <!-- Tgl Mulai Masuk Input -->
          <x-label for="mulaimasuk" :value="__('Tanggal Mulai Masuk')" required :invalid="$errors->has('mulaimasuk')" />
          <x-input id="mulaimasuk" type="date" name="mulaimasuk" :value="old('mulaimasuk')" :invalid="$errors->has('mulaimasuk')"
                   autocomplete="off" />
          @if (Session::has('error_tambah.mulaimasuk'))
            {{ Session::get('error_tambah.mulaimasuk') }}
            <br>
          @endif

          <!-- Ijazah Input -->
          <x-label for="ijazah" :value="__('Ijazah')" />
          <x-input id="ijazah" type="text" name="ijazah" :value="old('ijazah')"
                   placeholder="Masukkan Ijazah Anda" autocomplete="off" />
          @if (Session::has('error_tambah.ijazah'))
            {{ Session::get('error_tambah.ijazah') }}
            <br>
          @endif

          <!-- Pekerjaan Input -->
          <x-label for="id_level" :value="__('Posisi')" required :invalid="$errors->has('id_level')" />
          <x-select name="id_level" id="id_level" :invalid="$errors->has('id_level')">
            @foreach ($role as $r)
              <x-select-item value="{{ $r->id }}" selected="{{ old('id_level') == $r->id ? 'selected' : null }}" :invalid="$errors->has('id_level')">{{ ucfirst($r->keterangan) }}</x-select-item>
            @endforeach
            <x-select-item value="" :invalid="$errors->has('id_level')">Pilih Salah Satu</x-select-item>
          </x-select>
          @if (Session::has('error_tambah.id_level'))
            {{ Session::get('error_tambah.id_level') }}
            <br>
          @endif

          <!-- Status Kepegawaian Input -->
          {{-- <x-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
          <x-input id="status_kepegawaian" type="text" name="status_kepegawaian"
                   :value="old('status_kepegawaian')" placeholder="Masukkan Status Kepegawaian Anda"
                   autocomplete="off" />
          @if (Session::has('error_tambah.status_kepegawaian'))
            {{ Session::get('error_tambah.status_kepegawaian') }}
            <br>
          @endif --}}

          <x-label for="status_kepegawaian" :value="__('Status Kepegawaian')" required :invalid="$errors->has('status_kepegawaian')" />
          <div class="flex flex-wrap">
            @foreach ([1 => 'Aktif', 0 => 'Non-Aktif'] as $key => $status)
              <x-label for="{{ $status }}" class="flex cursor-pointer p-2" :invalid="$errors->has('status_kepegawaian')">
                <input class="my-auto scale-125 transform" type="radio" id="{{ $status }}" name="status_kepegawaian"
                       checked="{{ old('status_kepegawaian') == $key ? 'checked' : null }}" value="{{ $key }}" />
                <div class="px-2">{{ ucfirst($status) }}</div>
              </x-label>
            @endforeach
          </div>
          @if (Session::has('error_tambah.status_kepegawaian'))
            {{ Session::get('error_tambah.status_kepegawaian') }}
            <br>
          @endif

          <!-- Pelatihan Input -->
          <x-label for="pelatihan" :value="__('Pelatihan')" />
          <x-input id="pelatihan" type="text" name="pelatihan" :value="old('pelatihan')"
                   placeholder="Masukkan Pelatihan Anda" autocomplete="off" />
          @if (Session::has('error_tambah.pelatihan'))
            {{ Session::get('error_tambah.pelatihan') }}
            <br>
          @endif

          <!-- Foto Input -->
          <x-label for="foto" :value="__('Foto')" />
          <div class="flex items-center space-x-4">
            <img id="tambahPreviewImg"
                 src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                 class="previewImg h-40 w-40 rounded-full border-2 border-dashed border-gray-300 object-cover shadow"
                 alt="profile image">
            <input id="tambahFoto" type="file" name="foto" onchange="previewFile(this, 'tambah')">
          </div>


          <!-- Button Input -->
          <p class="mt-4 mb-6 flex flex-col items-center justify-center space-y-6 text-center text-lg text-gray-500 sm:flex-row">
            <input type="submit" class="mt-6 w-full cursor-pointer items-center rounded-md bg-indigo-400 px-4 py-4 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600 sm:mr-2 sm:w-1/2" value="Simpan">

            <a href="{{ route('pegawai.index') }}" class="w-full rounded-md border border-white px-4 py-4 text-lg font-medium text-indigo-400 transition duration-200 hover:border-red-900 hover:text-red-900 sm:ml-2 sm:w-1/2">
              Batal
            </a>
          </p>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>
