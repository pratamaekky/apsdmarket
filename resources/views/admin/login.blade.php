@include('admin.includes.head')

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to APSD Market CMS!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('doLogin') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="username" name="username" class="form-control form-control-user"
                                                id="inputUsername" placeholder="Enter Username..." value="{{ old('username') }}">
                                            @if ($errors->has('username'))
                                                <span class="text-danger">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group has-validation">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="inputPassword" placeholder="Enter Password..." value="{{ old('password') }}">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('admin.includes.foot')

</body>

</html>