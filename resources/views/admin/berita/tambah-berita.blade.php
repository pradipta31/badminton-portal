@extends('admin.layouts.master')
@section('title','Tambah Berita')

@section('content')
  <section class="content-header">
    <h1>
      Berita
      <small>Tambah Berita</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Tambah Berita</li>
    </ol>
  </section>
  <section class="content">
    <form class="" action="{{url('admin/berita/tambah-berita')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-9 col-sm-9 col-xs-9">
            <textarea name="isi" rows="13"></textarea>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Judul</label>
              <input type="text" name="judul" id="" class="form-control" placeholder="Masukan judul berita">
            </div>
            <input type="submit" name="publish" class="btn btn-primary btn-md" value="Publish">
            <input type="submit" name="archive" class="btn btn-success btn-md" value="Simpan Draft">
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Cover</label>
              <input type="file" name="gambar" id="">
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
@section('js')
<script src="{{asset('backend/plugins/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('backend/plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
          "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
          "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        toolbar_items_size: 'small',

        style_formats: [
          {title: 'Bold text', inline: 'b'},
          {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
          {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
          {title: 'Example 1', inline: 'span', classes: 'example1'},
          {title: 'Example 2', inline: 'span', classes: 'example2'},
          {title: 'Table styles'},
          {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        templates: [
          {title: 'Test template 1', content: 'Test 1'},
          {title: 'Test template 2', content: 'Test 2'}
        ]
    });
</script>
@endsection
