<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Add Admin </title> 
    <link rel="stylesheet" href="{{url('css/createadminstyles.css')}}">
   </head>
<body>
  <div class="wrapper">
    <div>
        <a href="{{url('admin/dashboard')}}">Back to Admin Page</a>
    </div>
    @if (session('success'))
        <div style="color:green;">{{session('success')}}</div>
    @endif
    <h2>Add New Admin</h2>
    <form action="{{url('admin/storeadmin')}}" method="post">
        @csrf
      <div class="input-box">
        <input type="text" placeholder="Enter name" name="name" required>
      </div>
      <div class="input-box">
        <input type="email" placeholder="Enter email" name="email" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Create password" name="password" required>
      </div>
      <div class="input-box">
        <select class="form-control" name="wilayah" id="wilayah" required>
          <option value="">-- Pilih Wilayah --</option>
            @foreach ($wilayah as $item)
              <option value="{{ $item->id_wilayah }}">{{ $item->nama_wilayah }}</option>
            @endforeach
        </select>
    </div>
      <div class="input-box button">
        <input type="Submit" value="Add Admin">
      </div>
      @error('email')
        <div class="text-danger" style="color:red;">{{ $message }}</div>
      @enderror
    </form>
  </div>
</body>
</html>