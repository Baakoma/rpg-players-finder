<template>
  <div style="width: 600px;">
      <h1 class="title is-1">Sign in</h1>
      <hr>
      <form method="post" @submit.prevent="login">
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
                  v-model="userData.password"
                  required
                  password-reveal>
              </b-input>
          </b-field>
          <b-button type="is-primary" native-type="submit">Sign in</b-button>
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
                    email: '',
                    password: '',
                }
            };
        },
        methods: {
            login() {
                this.$store.dispatch('login', this.userData)
                    .then(() => {
                        this.$router.push({ name: 'home'})
                            .then(() => Messenger.success('You\'re logged in'));
                    })
                    .catch((error) => {
                        const response = error.response;

                        if (response.status === 422) {
                            Messenger.error('Something went wront. Try again');
                        } else {
                            throw error;
                        }
                    });
            }
        }
    }
</script>
