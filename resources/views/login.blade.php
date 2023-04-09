<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <div class="card col-6">
            <div class="card-header">
                <h6>Login</h6>
            </div>
            <div class="card-body">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form id="login" action="{{ route('login.attempt') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input class="form-control @error('username') is-invalid @enderror" type="text"
                            name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                            name="password">
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    {{-- <script>

        const login = async (data) => {
            try {

                const response = await fetch('http://127.0.0.1:5000/auth/login', {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });
                const responseJson = await response.json();
                console.log('response:', responseJson);
                if (responseJson.success) {
                    console.log('Login Success');


                    localStorage.setItem('authUser', JSON.stringify(responseJson.data));
                    localStorage.setItem('accessToken', responseJson.access_token);
                    localStorage.setItem('refreshToken', responseJson.refresh_token);

                } else {
                    console.log(responseJson.message);
                }
                // return responseJson;
            } catch (error) {
                console.log(error);
                // return { success: false, message: 'Request failed, Please try again!' };
                // return error;
            }
        };
        const formLogin = document.getElementById('login')

        formLogin.addEventListener('submit', (e) => {

            e.preventDefault();
            let username = document.querySelector('input[name=username]').value
            let password = document.querySelector('input[name=password]').value

            let data = {
                username: username,
                password: password
            }
            console.log(data)


            login(data)

        })
    </script> --}}


</body>

</html>
