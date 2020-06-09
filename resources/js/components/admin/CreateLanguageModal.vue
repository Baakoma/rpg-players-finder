<template>
    <div>
        <div class="modal-card">
            <header class="modal-card-head has-background-primary">
                <p class="modal-card-title has-text-white">Add language</p>
            </header>
            <div class="modal-card-body">
                <b-field label="Name"
                         :type="{ 'is-danger': Errors.has('name') }"
                         :message="Errors.get('name')">
                    <b-input
                        type="text"
                        v-model="langData.name">
                    </b-input>
                </b-field>
            </div>
            <footer class="modal-card-foot">
                <button class="button" @click="cancelCreating">Cancel</button>
                <button class="button is-primary" @click="create">Submit</button>
            </footer>
            <b-loading :is-full-page="false" :active.sync="fetching"></b-loading>
        </div>
    </div>
</template>

<script>
    import Messenger from '../../helpers/Messenger';
    import Errors from '../../helpers/Errors';

    export default {
        data() {
            return {
                fetching: false,
                langData: {
                    name: '',
                },
                Errors: new Errors(),
            };
        },
        methods: {
            create() {
                this.fetching = true;
                this.$http.post(`/languages`, this.langData)
                    .then(() => {
                        this.$emit('created');
                        this.$parent.close();
                    })
                    .then(() => {
                        Messenger.success('Language added successfully');
                    })
                    .catch((error) => {
                        const response = error.response;

                        if (response.status === 422) {
                            this.Errors.fill(response.data);
                            Messenger.error(this.Errors.message);
                        } else {
                            Messenger.error('Something went wrong, try again later');
                        }
                    })
                    .finally(() => this.fetching = false);
            },
            cancelCreating() {
                this.$parent.close();
            }
        }
    }
</script>
