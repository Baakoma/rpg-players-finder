<template>
  <div style="width: 600px;">
      <h1 class="title is-1">Create your account</h1>
      <hr>
      <form method="post" @submit.prevent="register">
          <b-field label="Username">
              <b-input
                  type="text"
                  name="name"
                  required
                  v-model="userData.name">
              </b-input>
          </b-field>
          <b-field label="Email">
              <b-input
                  type="email"
                  name="email"
                  required
                  v-model="userData.email">
              </b-input>
          </b-field>
          <b-field label="Password">
              <b-input
                  type="password"
                  name="password"
                  required
                  v-model="userData.password"
                  password-reveal>
              </b-input>
          </b-field>
          <b-field label="Confirm password">
              <b-input
                  type="password"
                  required
                  name="passwordConfirmation"
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

    export default {
        data() {
            return {
                fetching: false,
                userData: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                }
            };
        },
        methods: {
            register() {
                this.fetching = true;
                this.$store.dispatch('register', this.userData)
                    .then(() => {
                        this.$router.push({ name: 'home'})
                            .then(() => Messenger.info('Your account has been created succesfully'))
                            .then(() => Messenger.success('You\'re logged in'))
                    })
                    .finally(() => {
                       this.fetching = false;
                    });
            }
        },
    }
</script>
