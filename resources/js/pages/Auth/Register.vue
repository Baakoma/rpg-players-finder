<template>
  <div style="width: 600px;">
      <h1 class="title is-1">Create your account</h1>
      <hr>
      <form method="post" @submit.prevent="register">
          <b-field label="Username"
                   :type="{ 'is-danger': Errors.has('name') }"
                   :message="Errors.get('name')">
              <b-input
                  type="text"
                  name="name"
                  @input="Errors.clear('name')"
                  v-model="userData.name">
              </b-input>
          </b-field>
          <b-field label="Email"
                   :type="{ 'is-danger': Errors.has('email') }"
                   :message="Errors.get('email')">
              <b-input
                  type="text"
                  name="email"
                  @input="Errors.clear('email')"
                  v-model="userData.email">
              </b-input>
          </b-field>
          <b-field label="Password"
                   :type="{ 'is-danger': Errors.has('password') }"
                   :message="Errors.get('password')">
              <b-input
                  type="password"
                  name="password"
                  @input="Errors.clear('password')"
                  v-model="userData.password"
                  password-reveal>
              </b-input>
          </b-field>
          <b-field label="Confirm password"
                   :type="{ 'is-danger': Errors.has('password_confirmation') }"
                   :message="Errors.get('password_confirmation')">
              <b-input
                  type="password"
                  @input="Errors.clear('password_confirmation')"
                  name="password_confirmation"
                  v-model="userData.password_confirmation">
              </b-input>
          </b-field>
          <b-button type="is-primary" native-type="submit">Create account</b-button>
      </form>
      <b-loading :is-full-page="false" :active.sync="fetching"></b-loading>
  </div>
</template>

<script>
    import Messenger from '../../helpers/Messenger';
    import Errors from '../../helpers/Errors';

    export default {
        data() {
            return {
                fetching: false,
                userData: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                Errors: new Errors(),
            };
        },
        methods: {
            register() {
                this.fetching = true;
                this.Errors.clear();
                this.$store.dispatch('register', this.userData)
                    .then(() => {
                        this.$router.push({ name: 'home'})
                            .then(() => Messenger.info('Your account has been created succesfully'))
                            .then(() => Messenger.success('You are logged in'))
                    })
                    .catch((error) => {
                        const response = error.response;

                        if (response.status === 422) {
                            this.Errors.fill(response.data);
                            Messenger.error(this.Errors.message);
                        } else {
                            throw error;
                        }
                    })
                    .finally(() => this.fetching = false);
            }
        },
    }
</script>
