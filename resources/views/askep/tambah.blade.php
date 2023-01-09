<x-app-layout>
  <div class="flex h-screen w-full" x-data="{ modalAddPenghuni: false, modalDetailUser: false, modalEditPenghuni: false, modalGantiPassword: false }" :class="{ 'overflow-y-hidden': modalAddPenghuni || modalDetailUser || modalEditPenghuni || modalGantiPassword }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-12 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Tambah Asuhan Keperawatan</h2>
        </header>
        @if (count($errors) > 0)
          <div class="mb-4 rounded-md border border-red-200 bg-red-100 py-3 px-5 text-sm text-red-900" role="alert">
            Mohon isi semua yang bertanda bintang
          </div>
        @endif

        {{-- @if (Session::get('success'))
          <div class="mb-4 rounded-md border border-green-200 bg-green-100 py-3 px-5 text-sm text-green-900" role="alert">
            {{ Session::get('success') }}
          </div>
        @endif --}}
        <form method="POST" class="break-word" action="{{ route('askep.proses_tambah') }}" enctype="multipart/form-data">
          @csrf
          <!-- nama Input -->
          {{-- <x-label for="editnama" :value="__('Nama Penghuni')" />
          <x-input invalid="{{ $errors->has('nama') ? 'true' : 'false' }}" id="editnama" type="text" name="nama" value="{{ old('nama') ? old('nama') : '' }}" placeholder=" Masukkan Nama Penghuni Baru" autocomplete="off" />
          @if (Session::has('error_update.nama'))
            {{ Session::get('error_update.nama') }}
            <br>
          @endif --}}

          <!-- Pegawai Input -->
          <x-label for="select-pegawai" :value="__('Pembuat Data')" :invalid="$errors->has('pegawai')" required />
          <x-select-2 id="select-pegawai" name="pegawai" placeholder="Pilih Pegawai" :invalid="$errors->has('pegawai')">
            @foreach ($pegawai as $row)
              <option value="{{ $row->id }}" {{ old('pegawai') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
            @endforeach
          </x-select-2>

          <!-- PJ 1 Input -->
          <x-label for="select-id_pj_1" :value="__('Penanggung Jawab Shift 1')" :invalid="$errors->has('id_pj_1')" />
          <x-select-2 id="select-id_pj_1" name="id_pj_1" placeholder="Pilih Penanggung Jawab Shift 1" :invalid="$errors->has('id_pj_1')">
            @foreach ($pegawai as $row)
              <option value="{{ $row->id }}" {{ old('pegawai') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
            @endforeach
          </x-select-2>
          <!-- PJ 2 Input -->
          <x-label for="select-id_pj_2" :value="__('Penanggung Jawab Shift 2')" :invalid="$errors->has('id_pj_2')" />
          <x-select-2 id="select-id_pj_2" name="id_pj_2" placeholder="Pilih Penanggung Jawab Shift 2" :invalid="$errors->has('id_pj_2')">
            @foreach ($pegawai as $row)
              <option value="{{ $row->id }}" {{ old('pegawai') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
            @endforeach
          </x-select-2>
          <!-- PJ 3 Input -->
          <x-label for="select-id_pj_3" :value="__('Penanggung Jawab Shift 1')" :invalid="$errors->has('id_pj_3')" />
          <x-select-2 id="select-id_pj_3" name="id_pj_3" placeholder="Pilih Penanggung Jawab Shift 3" :invalid="$errors->has('id_pj_3')">
            @foreach ($pegawai as $row)
              <option value="{{ $row->id }}" {{ old('pegawai') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
            @endforeach
          </x-select-2>

          <!-- Penghuni Input -->
          <x-label for="select-penghuni" :value="__('Penghuni')" :invalid="$errors->has('penghuni')" required />
          <x-select-2 id="select-penghuni" name="penghuni" placeholder="Pilih Penghuni" :invalid="$errors->has('penghuni')" disabled>
            @foreach ($penghuni as $row)
              <option value="{{ $row->id }}" {{ old('penghuni') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
            @endforeach
          </x-select-2>

          {{-- Diagnosa --}}
          <x-label for="select-diagnosa" :value="__('Diagnosa')" :invalid="$errors->has('diagnosa')" required />
          <x-select-2 id="select-diagnosa" name="diagnosa" placeholder="Pilih Diagnosa" :invalid="$errors->has('diagnosa')">
            @foreach ($diagnosa as $row)
              <option value="{{ $row->id }}" {{ old('diagnosa') == $row->id ? 'selected' : '' }}>{{ $row->diagnosa }}</option>
            @endforeach
          </x-select-2>

          <div id="options" class="hidden">
            {{-- Gejala --}}
            <x-label for="select-gejala" :value="__('Gejala')" />
            <select id="select-gejala" name="gejala[]" multiple="multiple">
            </select>
            {{-- penyebab --}}
            <x-label for="select-penyebab" :value="__('Penyebab')" />
            <select id="select-penyebab" name="penyebab[]" multiple="multiple">
            </select>
            {{-- intervensi --}}
            <x-label for="select-intervensi" :value="__('Intervensi')" />
            <select id="select-intervensi" name="intervensi[]" multiple="multiple">
            </select>
          </div>

          <x-horizontal></x-horizontal>
          <div id="evaluasi">
            <x-label for="eval" :value="__('<b>Evaluasi</b>')" />
          </div>
          <a id="tambah-evaluasi" href="#" class="my-4 w-full rounded-md border border-white px-4 py-4 text-lg font-medium text-indigo-400 transition duration-200 hover:border-red-900 hover:text-red-900 sm:ml-2 sm:w-1/2">
            Tambah Form Evaluasi
          </a>
          <!-- Button Input -->
          <p class="mt-4 mb-6 flex flex-col items-center justify-center space-y-6 text-center text-lg text-gray-500 sm:flex-row">
            <input type="submit" class="mt-6 w-full items-center rounded-md bg-indigo-400 px-4 py-4 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600 sm:w-1/2" value="Simpan">

            <a href="{{ route('askep.index') }}" class="w-full rounded-md border border-white px-4 py-4 text-lg font-medium text-indigo-400 transition duration-200 hover:border-red-900 hover:text-red-900 sm:ml-2 sm:w-1/2">
              Kembali
            </a>
          </p>
        </form>
      </div>
      <x-bottom-spacer></x-bottom-spacer>
    </div>
  </div>

  <script>
    function previewFile(input, change) {
      var file = $("#edittambahFoto").get(0).files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function() {
          $('#edittambahPreviewImg').attr("src", reader.result);
        }
        reader.readAsDataURL(file);
      }
    }

    $(document).ready(function() {
      $('#select-diagnosa').select2({
        tags: true
      });
      $('#select-gejala').select2({
        tags: true
      });
      $('#select-penyebab').select2({
        tags: true
      });
      $('#select-intervensi').select2({
        tags: true
      });
      $('#select-penghuni').select2();
      $('#select-pegawai').select2();
      $('#select-id_pj_1').select2();
      $('#select-id_pj_2').select2();
      $('#select-id_pj_3').select2();
    });

    $(document).ready(function() {
      $("#select-diagnosa").change(function() {
        id_diagnosa = $(this).val();
        console.log(id_diagnosa);

        $.ajax({
          "url": "{{ route('askep.form_gejala') }}",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}",
            id_diagnosa: id_diagnosa
          },
          success: function(result) {
            console.log(result);
            arr = $.parseJSON(result); //convert to javascript array

            gejalaHtml = ""
            $.each(arr['gejala'], function(key, value) {
              gejalaHtml += "<option value='" + value['id'] + "'>" + value['gejala'] + "</option>";
            });
            $("#select-gejala").html(gejalaHtml);

            penyebabHtml = ""
            $.each(arr['penyebab'], function(key, value) {
              penyebabHtml += "<option value='" + value['id'] + "'>" + value['penyebab'] + "</option>";
            });
            $("#select-penyebab").html(penyebabHtml);

            intervensiHtml = ""
            $.each(arr['intervensi'], function(key, value) {
              intervensiHtml += "<option value='" + value['id'] + "'>" + value['intervensi'] + "</option>";
            });
            $("#select-intervensi").html(intervensiHtml);
          }
        });
        $('#options').removeClass("hidden");
      });


      if ("{{ old('diagnosa') }}" != "") {
        $('#select-diagnosa').trigger('change');
      };

    });

    $(document).ready(function() {
      var totalEvaluasi = 0;
      $('#tambah-evaluasi').on('click', (e) => {
        e.preventDefault();
        totalEvaluasi += 1;
        var evaluasi = $('#evaluasi').append(`
          <div class="flex items-stretch content-center w-full">
              <x-input name="eval${totalEvaluasi}" type="text" id="eval${totalEvaluasi}"/>
              <a id="hapus-evaluasi-${totalEvaluasi}" 
                  href="#" 
                  class="mb-4 flex items-center rounded-md border border-red px-4 text-lg font-medium text-white bg-red-400 transition duration-200 hover:border-red-900 hover:bg-red-900 sm:ml-2"
                  onClick="deleteEval(${totalEvaluasi})"
              >
                <i class="bi bi-trash-fill"></i>
              </a>
          </div>
        `);
      })

      // console.log("{!! json_encode(session()->get('eval_key')) !!}");
      var oldEval = $.parseJSON(`{!! json_encode(session()->get('eval_key')) !!}`);
      var oldData = $.parseJSON(`{!! json_encode(session()->getOldInput()) !!}`);
      if (oldEval) {
        oldEval.forEach(element => {
          console.log(oldData);
          console.log(element);
          console.log(oldData[element]);
          totalEvaluasi += 1;
          var evaluasi = $('#evaluasi').append(`
          <div class="flex items-stretch content-center w-full">
              <x-input name="eval${totalEvaluasi}" type="text" id="eval${totalEvaluasi}" value="${oldData[element]}"/>
              <a id="hapus-evaluasi-${totalEvaluasi}" 
                  href="#" 
                  class="mb-4 flex items-center rounded-md border border-red px-4 text-lg font-medium text-white bg-red-400 transition duration-200 hover:border-red-900 hover:bg-red-900 sm:ml-2"
                  onClick="deleteEval(${totalEvaluasi})"
              >
                <i class="bi bi-trash-fill"></i>
              </a>
          </div>
        `);
        });
      }
    })

    function deleteEval(i) {
      $(`#label-eval${i}`).remove();
      $(`#eval${i}`).remove();
      $(`#hapus-evaluasi-${i}`).remove()
    }
  </script>
</x-app-layout>
