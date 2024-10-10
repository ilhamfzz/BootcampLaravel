@extends('layouts.master')
@section('title')
    Register
@endsection
@section('content')
    <h1>Buat Akun Baru!</h1>
    <h3>Sign Up Form</h3>
    <form action="/welcome" method="POST">
      @csrf
      <label for="fname">First Name:</label><br />
      <input type="text" name="fname" id="fname" /><br /><br />
      <label for="lname">Last Name:</label><br />
      <input type="text" name="lname" id="lname" /><br /><br />
      <label for="gender">Gender:</label><br />
      <input type="radio" name="gender" id="gender" />Male <br />
      <input type="radio" name="gender" id="gender" />Female <br />
      <input type="radio" name="gender" id="gender" />Other<br /><br />
      <label for="nationally">Nationally:</label><br />
      <select name="nationally" id="nationally">
        <option value="indonesian">Indonesian</option>
        <option value="other">Other</option></select
      ><br /><br />
      <label for="language">Language Spoken:</label><br />
      <input type="checkbox" name="language" id="language" />Bahasa Indonesia
      <br />
      <input type="checkbox" name="language" id="language" />English <br />
      <input type="checkbox" name="language" id="language" />Other <br />
      <br />
      <label for="bio">Bio:</label> <br />
      <textarea name="bio" id="bio" rows="10" cols="30"></textarea> <br />
      <br />
      <input type="submit" name="submit" />
    </form>
@endsection