<x-app-layout>
  <div class="flex h-screen w-full">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <h2 class="text-2xl font-semibold uppercase">Edit Pegawai</h2>
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
        {{-- {{ dd($user[0]) }} --}}
        <form method="POST" action="{{ route('pegawai.prosesubah') }}"
              enctype="multipart/form-data">
          @csrf
          <!-- NIP Input -->
          <x-label for="id" :value="__('Nomor Induk Pegawai')" />
          <x-input class="bg-gray-100" id="id" type="text" name="id" value="{{ old('id') !== null ? old('id') : $user[0]->id }}" readonly />

          <!-- nama Input -->
          <x-label for="nama" :value="__('Nama Lengkap')" required :invalid="$errors->has('nama')" />
          <x-input id="nama" type="text" name="nama" value="{{ old('nama') !== null ? old('nama') : $user[0]->nama }}" :invalid="$errors->has('nama')"
                   placeholder="Masukkan Nama Lengkap" autocomplete="off" />
          @if (Session::has('error_update.nama'))
            {{ Session::get('error_update.nama') }}
            <br>
          @endif

          <!-- NIK Input -->
          <x-label for="nik" :value="__('NIK (Sesuai KTP)')" required :invalid="$errors->has('nik')" />
          <x-input id="nik" type="text" name="nik" value="{{ old('nik') !== null ? old('nik') : $user[0]->NIK }}" :invalid="$errors->has('nik')"
                   placeholder="Masukkan NIK" autocomplete="off" />
          @if (Session::has('error_tambah.nik'))
            {{ Session::get('error_tambah.nik') }}
            <br>
          @endif

          <!-- Tgl Lahir Input -->
          <x-label for="tgl_lahir" :value="__('Tanggal Lahir')" required :invalid="$errors->has('tgl_lahir')" />
          <x-input id="tgl_lahir" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') !== null ? old('tgl_lahir') : $user[0]->tgl_lahir }}"
                   :invalid="$errors->has('tgl_lahir')" autocomplete="off" />
          @if (Session::has('error_tambah.tgl_lahir'))
            {{ Session::get('error_tambah.tgl_lahir') }}
            <br>
          @endif

          <!-- Jenis kelamin Input -->
          <x-label for="gender" :value="__('Jenis Kelamin')" required :invalid="$errors->has('gender')" />
          <div class="flex flex-wrap">
            @foreach (['pria', 'wanita'] as $gender)
              <x-label for="{{ $gender }}" class="flex cursor-pointer p-2" :invalid="$errors->has('gender')">
                <input class="my-auto scale-125 transform" type="radio" id="{{ $gender }}" name="gender"
                       value="{{ $gender }}" checked="{{ old('gender') == $gender || $user[0]->gender == $gender ? 'checked' : null }}" />
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
                       value="{{ $agama }}" checked="{{ old('agama') == $agama || $user[0]->agama == $agama ? 'checked' : null }}" />
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
          <x-input id="alamat" type="text" name="alamat" value="{{ old('alamat') !== null ? old('alamat') : $user[0]->alamat }}"
                   placeholder="Masukkan Alamat Anda" autocomplete="off" :invalid="$errors->has('alamat')" />
          @if (Session::has('error_tambah.alamat'))
            {{ Session::get('error_tambah.alamat') }}
            <br>
          @endif

          <!-- Nomor Telepon Input -->
          <x-label for="notelp" :value="__('Nomor Telepon')" />
          <x-input class="appearance-none" id="notelp" type="number" name="notelp" value="{{ old('notelp') !== null ? old('notelp') : $user[0]->notelp }}"
                   placeholder="Masukkan Nomor Telepon Anda" autocomplete="off" />
          @if (Session::has('error_tambah.notelp'))
            {{ Session::get('error_tambah.notelp') }}
            <br>
          @endif

          <!-- Tgl Mulai Masuk Input -->
          <x-label for="mulaimasuk" :value="__('Tanggal Mulai Masuk')" required :invalid="$errors->has('mulaimasuk')" />
          <x-input id="mulaimasuk" type="date" name="mulaimasuk" value="{{ old('mulaimasuk') !== null ? old('mulaimasuk') : $user[0]->mulaimasuk }}"
                   :invalid="$errors->has('mulaimasuk')" autocomplete="off" />
          @if (Session::has('error_tambah.mulaimasuk'))
            {{ Session::get('error_tambah.mulaimasuk') }}
            <br>
          @endif

          <!-- Ijazah Input -->
          <x-label for="ijazah" :value="__('Ijazah')" />
          <x-input id="ijazah" type="text" name="ijazah" value="{{ old('ijazah') !== null ? old('ijazah') : $user[0]->ijazah }}"
                   placeholder="Masukkan Ijazah Anda" autocomplete="off" />
          @if (Session::has('error_tambah.ijazah'))
            {{ Session::get('error_tambah.ijazah') }}
            <br>
          @endif

          <!-- Pekerjaan Input -->
          <x-label for="id_level" :value="__('Posisi')" required :invalid="$errors->has('id_level')" />
          <x-select name="id_level" id="id_level" :invalid="$errors->has('id_level')">
            <x-select-item value="">Pilih Salah Satu</x-select-item>
            @foreach ($role as $r)
              <option value="{{ $r->id }}" {!! $r->id == $user[0]->id_level ? 'selected' : '' !!}>{{ ucfirst($r->keterangan) }}</option>
            @endforeach
          </x-select>
          @if (Session::has('error_tambah.id_level'))
            {{ Session::get('error_tambah.id_level') }}
            <br>
          @endif

          <!-- Status Kepegawaian Input -->
          <x-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
          <div class="flex flex-wrap">
            @foreach ([1 => 'Aktif', 0 => 'Non-Aktif'] as $key => $status)
              <x-label for="{{ $status }}" class="flex cursor-pointer p-2">
                <input class="my-auto scale-125 transform" type="radio" id="{{ $status }}" name="status_kepegawaian"
                       value="{{ $key }}" {{ $user[0]->status == $key ? 'checked' : '' }} />
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
          <x-input id="pelatihan" type="text" name="pelatihan" value="{{ old('pelatihan') !== null ? old('pelatihan') : $user[0]->pelatihan }}"
                   placeholder="Masukkan Pelatihan Anda" autocomplete="off" />
          @if (Session::has('error_tambah.pelatihan'))
            {{ Session::get('error_tambah.pelatihan') }}
            <br>
          @endif

          <!-- Foto Input -->
          <x-label for="foto" :value="__('Foto')" />
          <div class="flex items-center space-x-4">
            <img id="tambahPreviewImg"
                 src="{{ $user[0]->foto != null ? URL::to('/photos/' . $user[0]->foto) : 'https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png' }}"
                 class="previewImg h-40 w-40 rounded-full border-2 border-dashed border-gray-300 object-cover shadow"
                 alt="profile image">
            <input id="tambahFoto" type="file" name="foto" onchange="previewFile(this, 'tambah')">
            <a href="#" class="inline-block rounded-md bg-red-600 p-5 text-white hover:bg-red-300 hover:text-black" id="hapusFoto" onclick="previewFile($('#tambahFoto'), 'hapus')">Hapus Foto</a href="#">
          </div>


          <!-- Button Input -->
          <p class="mt-4 mb-6 flex flex-col items-center justify-center space-y-6 text-center text-lg text-gray-500 sm:flex-row">
            <input type="submit" class="mt-6 w-full cursor-pointer items-center rounded-md bg-indigo-400 px-4 py-4 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600 sm:mr-2 sm:w-1/2" value="Simpan">
            <a class="w-full rounded-md border border-white px-4 py-4 text-lg font-medium text-indigo-400 transition duration-200 hover:border-red-900 hover:text-red-900 sm:ml-2 sm:w-1/2" href="{{ route('pegawai.index') }}">Batal</a>
          </p>

        </form>
      </div>
    </div>
  </div>

  <script>
    function previewFile(input, change) {
      if (change == "edit") {
        // var file = $("input[type=file]").get(0).files[0];
        var file = $("#editFoto").get(0).files[0];
      } else if (change == "tambah") {
        var file = $("#tambahFoto").get(0).files[0];
      }
      console.log(change);
      if (change == "hapus") {
        $('#tambahPreviewImg').attr("src", 'https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png');
        $('#tambahFoto').val(null);
      }
      if (file) {
        var reader = new FileReader();
        reader.onload = function() {
          if (change == "edit") {
            $('#editPreviewImg').attr("src", reader.result);
          } else if (change == "tambah") {
            $('#tambahPreviewImg').attr("src", reader.result);
          }
        }
        reader.readAsDataURL(file);
      }
    }
  </script>
</x-app-layout>
