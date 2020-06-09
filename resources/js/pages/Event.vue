<template>
    <div class="container">
        <div>

        </div>
        <div class="columns" v-if="!fetching">
            <div class="column is-8">
                <b-field label="Name"
                         :type="{ 'is-danger': Errors.has('name') }"
                         :message="Errors.get('name')">
                    <b-input
                        type="text"
                        disabled
                        v-model="eventData.name">
                    </b-input>
                </b-field>
                <b-field label="Description"
                         :type="{ 'is-danger': Errors.has('description') }"
                         :message="Errors.get('description')">
                    <b-input
                        type="textarea"
                        disabled
                        v-model="eventData.description">
                    </b-input>
                </b-field>
                <b-field label="Public access"
                         :type="{ 'is-danger': Errors.has('public_access') }"
                         disabled
                         :message="Errors.get('public_access')">
                    <b-switch v-model="eventData.public_access" disabled>
                        Everyone can see the event
                    </b-switch>
                </b-field>
                <b-field label="Max players"
                         :type="{ 'is-danger': Errors.has('max_users') }"
                         :message="Errors.get('max_users')">
                    <b-numberinput
                        disabled
                        v-model="eventData.max_users">
                    </b-numberinput>
                </b-field>
                <b-field
                    label="Roleplaying system">
                    <b-select
                        placeholder="Select system"
                        disabled
                        v-model="eventData.system.id">
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
                        disabled
                        placeholder="Select type"
                        v-model="eventData.type.id">
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
                        disabled
                        placeholder="Select language"
                        v-model="eventData.language.id">
                        <option
                            v-for="lang in languages"
                            :value="lang.id"
                            :key="lang.id">
                            {{ lang.name }}
                        </option>
                    </b-select>
                </b-field>
            </div>
            <div class="column is-4">
                <h2 class="subtitle has-text-centered">Player list</h2>
                <div class="box" v-for="player in eventData.players">
                    {{ player.name }}
                </div>
            </div>
        </div>
        <b-loading :active.sync="fetching"></b-loading>
    </div>
</template>

<script>
    import Messenger from '../helpers/Messenger';
    import Errors from '../helpers/Errors';
    import {mapGetters} from 'vuex';

    export default {
        computed: {
            ...mapGetters(['user']),
            eventId() {
                return this.$route.params.id;
            },
        },
        data() {
            return {
                fetching: false,
                systems: [],
                languages: [],
                types: [],
                eventData: null,
                Errors: new Errors(),
            };
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.fetching = true;

                const fetchEvent = this.$http.get(`/events/${this.eventId}`);
                const fetchSystems = this.$http.get(`/systems`);
                const fetchLanguages = this.$http.get(`/languages`);
                const fetchTypes = this.$http.get(`/types`);

                Promise.all([fetchEvent, fetchSystems, fetchLanguages, fetchTypes])
                    .then(([eventRes, systemRes, langRes, typeRes] ) => {
                        this.eventData = eventRes.data;
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
