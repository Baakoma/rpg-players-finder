<template>
    <div>
        <div class="modal-card">
            <header class="modal-card-head has-background-primary">
                <p class="modal-card-title has-text-white">Create event</p>
            </header>
            <div class="modal-card-body">
                <b-field label="Name"
                         :type="{ 'is-danger': Errors.has('name') }"
                         :message="Errors.get('name')">
                    <b-input
                        type="text"
                        v-model="eventData.name">
                    </b-input>
                </b-field>
                <b-field label="Description"
                         :type="{ 'is-danger': Errors.has('description') }"
                         :message="Errors.get('description')">
                    <b-input
                        type="textarea"
                        v-model="eventData.description">
                    </b-input>
                </b-field>
                <b-field label="Public access"
                         :type="{ 'is-danger': Errors.has('public_access') }"
                         :message="Errors.get('public_access')">
                    <b-switch v-model="eventData.public_access">
                        Everyone can see the event
                    </b-switch>
                </b-field>
                <b-field label="Max players"
                         :type="{ 'is-danger': Errors.has('max_users') }"
                         :message="Errors.get('max_users')">
                    <b-numberinput
                        v-model="eventData.max_users">
                    </b-numberinput>
                </b-field>
                <b-field
                    label="Roleplaying system">
                    <b-select
                        placeholder="Select system"
                        v-model="eventData.system_id">
                        <option
                            v-for="system in systems"
                            :value="system.id"
                            :key="system.id">
                            {{ system.name }}
                        </option>
                    </b-select>
                </b-field>
                <b-field
                    label="Preferable table game style">
                    <b-select
                        placeholder="Select type"
                        v-model="eventData.type_id">
                        <option
                            v-for="type in types"
                            :value="type.id"
                            :key="type.id">
                            {{ type.name }}
                        </option>
                    </b-select>
                </b-field>
                <b-field
                    label="Preferable language">
                    <b-select
                        placeholder="Select language"
                        v-model="eventData.language_id">
                        <option
                            v-for="lang in languages"
                            :value="lang.id"
                            :key="lang.id">
                            {{ lang.name }}
                        </option>
                    </b-select>
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
    import Messenger from '../helpers/Messenger';
    import Errors from '../helpers/Errors';
    import {mapGetters} from 'vuex';

    export default {
        computed: {
            ...mapGetters(['user'])
        },
        data() {
            return {
                fetching: false,
                systems: [],
                languages: [],
                types: [],
                eventData: {
                    name: '',
                    description: '',
                    language_id: null,
                    system_id: null,
                    type_id: null,
                    max_users: 0,
                    public_access: true,
                },
                Errors: new Errors(),
            };
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.fetching = true;
                const fetchSystems = this.$http.get(`/systems`);
                const fetchLanguages = this.$http.get(`/languages`);
                const fetchTypes = this.$http.get(`/types`);

                Promise.all([fetchSystems, fetchLanguages, fetchTypes])
                    .then(([systemRes, langRes, typeRes] ) => {
                        this.systems = systemRes.data;
                        this.languages = langRes.data;
                        this.types = typeRes.data;
                    })
                    .catch(() => {
                        Messenger.error('Could not load data');
                    })
                    .finally(() => this.fetching = false);
            },
            create() {
                this.fetching = true;
                this.eventData.owner_id = this.user.id;
                this.$http.post(`/events`, this.eventData)
                    .then(() => {
                        this.$emit('created');
                        this.$parent.close();
                    })
                    .then(() => {
                        Messenger.success('Event created successfully');
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
