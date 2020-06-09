<template>
  <div style="width: 600px;">
      <h1 class="title is-1">Sign in</h1>
      <hr>
      <form method="post" @submit.prevent="login">
          <b-field label="Email"
                   :type="{ 'is-danger': Errors.has('email') }"
                   :message="Errors.get('email')">
              <b-input
                  type="text"
                  name="email"
                  v-model="userData.email"
                  @input="Errors.clear('email')">
              </b-input>
          </b-field>
          <b-field label="Password"
                   :type="{ 'is-danger': Errors.has('password') }"
                   :message="Errors.get('password')">
              <b-input
                  type="password"
                  name="password"
                  v-model="userData.password"
                  @input="Errors.clear('password')"
                  password-reveal>
              </b-input>
          </b-field>
          <b-button type="is-primary" native-type="submit" :disabled="Errors.any()">Sign in</b-button>
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
                    email: '',
                    password: '',
                },
                Errors: new Errors(),
            };
        },
        methods: {
            login() {
                this.fetching = true;
                this.Errors.clear();
                this.$store.dispatch('login', this.userData)
                    .then(() => {
                        this.$router.push({ name: 'home'})
                            .then(() => Messenger.success('You are logged in'));
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
        }
    }
</script>
