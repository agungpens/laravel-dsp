@extends('template.main')

@section('content')
    {{-- alert success & error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $errors->first() }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h6>Ubah Username dan Password</h6>

    <hr class="my-4">
    <form action="{{ url('update-profile/' . auth()->user()->id) }}" method="post" id="update-profile-form">
        @csrf
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username..." id="inputUsername">
                </div>
                <div class="form-group">
                    <label for="password1">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="****" id="password1">
                </div>
                <div class="form-group">
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" class="form-control" placeholder="****" id="password2">
                    <span id='message'></span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Change</button>
    </form>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $("#password2").keyup(function() {
                var password = $("#password1").val();
                var confirmPassword = $("#password2").val();

                if (password != confirmPassword)
                    $("#message").html("Passwords do not match!").css("color", "red");
                else
                    $("#message").html("Passwords match.").css("color", "green");
            });
        });
    </script>
@endsection
