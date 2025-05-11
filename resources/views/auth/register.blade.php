<x-app-layout>
    <x-page-header title="Register" />

        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Create an Account</h3>
                                        </div>

                                        @include('errors')

                                        <form method="post" action="{{ route('register') }}">
                                            @csrf

                                            <div class="form-group">
                                                <input type="text" required="" name="username" placeholder="Username" value="{{ old('username') }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="name" placeholder="Name" value="{{ old('name') }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Email" value="{{ old('email') }}">
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" placeholder="Confirm password">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Submit &amp; Register</button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">Already have an account? <a href="{{ route('login') }}">Sign in now</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <img src="{{ url('/images/login.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</x-app-layout>
