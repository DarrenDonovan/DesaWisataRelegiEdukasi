<!-- <!DOCTYPE html>
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
        <a href="{{url('admin')}}">Back to Admin Page</a>
    </div>
    @if (session('success'))
        <div style="color:green;">{{session('success')}}</div>
    @endif
    <h2>Add New Admin</h2>
    <form action="{{ route('removeAdmin')}}" method="post">
        @csrf
      <div class="input-box">
        <select class="form-control" name="wilayah" id="wilayah" required>
          <option value="">-- Pilih Admin --</option>
              @foreach($user as $items)
                <option value="{{ $items->id }}">{{ $items->name }}</option>
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
</html> -->