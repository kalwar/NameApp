<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name and Color Form</title>
  <style>
  body {
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
  }

  .container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
  }

  h2,
  h3 {
    color: #333;
    text-align: center;
  }

  .message {
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
  }

  .success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  label {
    display: block;
    margin-bottom: 5px;
    color: #555;
  }

  input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type="text"]:focus {
    border-color: #4a90e2;
    outline: none;
  }

  .error-text {
    color: #dc3545;
    font-size: 0.85em;
    margin-top: -8px;
    margin-bottom: 10px;
  }

  button {
    width: 100%;
    padding: 10px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #357abd;
  }

  ul {
    list-style: none;
    padding: 0;
    margin-top: 20px;
  }

  li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 4px;
    margin-bottom: 8px;
  }

  a,
  .delete-btn {
    color: #4a90e2;
    text-decoration: none;
    margin-right: 15px;
  }

  a:hover,
  .delete-btn:hover {
    color: #357abd;
    text-decoration: underline;
  }

  .delete-btn {
    color: #dc3545;
    background: none;
    border: none;
    cursor: pointer;
  }

  .delete-btn:hover {
    color: #a71d2a;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>Enter Name and Color</h2>

    <!-- Display success/error messages -->
    @if (session('success'))
    <div class="message success">
      {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="message error">
      {{ session('error') }}
    </div>
    @endif

    <!-- Form for adding or editing -->
    <form action="{{ isset($edit_id) ? route('name.update', $edit_id) : route('name.store') }}" method="POST">
      @csrf
      @if (isset($edit_id))
      @method('PUT')
      @endif
      <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', isset($edit_name) ? $edit_name : '') }}">
        @error('name')
        <p class="error-text">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label for="color">Color</label>
        <input type="text" name="color" id="color" value="{{ old('color', isset($edit_color) ? $edit_color : '') }}">
        @error('color')
        <p class="error-text">{{ $message }}</p>
        @enderror
      </div>
      <button type="submit">{{ isset($edit_id) ? 'Update' : 'Submit' }}</button>
    </form>

    <!-- List of names -->
    @if (!empty($names))
    <h3>Stored Names</h3>
    <ul>
      @foreach ($names as $index => $entry)
      <li>
        <span style="color: {{ $entry['color'] }}">{{ $entry['name'] }}</span>
        <div>
          <a href="{{ route('name.edit', $index) }}">Edit</a>
          <form action="{{ route('name.destroy', $index) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn"
              onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
          </form>
        </div>
      </li>
      @endforeach
    </ul>
    @endif
  </div>
</body>

</html>