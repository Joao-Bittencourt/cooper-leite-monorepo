<template>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Cooper Leite</b> </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="/login" method="post" @submit.prevent="loginSubmit()">
                    <div class="input-group mb-3">
                        <input type="email" v-model="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" v-model="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <p class="mb-1">
                    <a href="/forgot-password">I forgot my password</a>
                </p> -->
                <p class="mb-0">
                    <a href="/register" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
import { login } from '../services/AuthService.js';

export default {
    beforeMount() {
        $('body').remove('sidebar-mini').addClass('login-page');
        $('title').html('Login | Cooper Leite');
    },
    data() {
        return {
            email: '',
            password: ''
        };
    },
    methods: {
        loginSubmit() {

            login(this.email, this.password)
                .then(response => {
                    console.log(response);
                    this.$router.push('/');
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>