<template>
    <div class="container">
        <b-loading :active.sync="fetching"></b-loading>
        <div v-if="!fetching" class="container">
            <b-field label="Description"
                     :type="{ 'is-danger': Errors.has('description') }"
                     :message="Errors.get('description')">
                <b-input type="textarea" rows="6" expanded
                         v-model="profile.description">
                </b-input>
            </b-field>
            <b-field label="Gender">
                <b-select placeholder="Please, select your gender"
                          v-model="profile.sex">
                    <option value="0">No answer</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                </b-select>
            </b-field>
            <b-field label="Webcam"
                     :type="{ 'is-danger': Errors.has('camera') }"
                     :message="Errors.get('camera')">
                <b-switch v-model="profile.camera">
                    I'm using a webcam
                </b-switch>
            </b-field>
            <b-field label="Select a date"
                     :type="{ 'is-danger': Errors.has('birth_date') }"
                     :message="Errors.get('birth_date')"
                     style="max-width: 300px;">
                <b-datepicker
                    placeholder="Click to select..."
                    v-model="profile.birth_date"
                    icon="calendar"
                    :date-formatter="dateFormatter"
                    trap-focus>
                </b-datepicker>
            </b-field>
            <b-field label="Discord" style="max-width: 300px;"
                     :type="{ 'is-danger': Errors.has('discord') }"
                     :message="Errors.get('discord')">
                <b-input type="text" placeholder="Discord username"
                         v-model="profile.discord">
                </b-input>
            </b-field>
            <div class="label">Roleplaying system(s)</div>
            <div class="block">
                <b-checkbox
                    v-for="system in systems"
                    v-model="profile.systems"
                    :key="system.id"
                    :native-value="system.id">
                    {{ system.name }}
                </b-checkbox>
            </div>
            <div class="label">Preferable language(s)</div>
            <div class="block">
                <b-checkbox
                    v-for="lang in languages"
                    v-model="profile.languages"
                    :key="lang.id"
                    :native-value="lang.id">
                    {{ lang.name }}
                </b-checkbox>
            </div>
            <div class="label">Preferable table game style(s)</div>
            <div class="block">
                <b-checkbox
                    v-for="type in types"
                    v-model="profile.types"
                    :key="type.id"
                    :native-value="type.id">
                    {{ type.name }}
                </b-checkbox>
            </div>
            <div class="block mt-10">
                <b-button type="is-primary" class="is-pulled-right" @click="updateProfile">Update profile</b-button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Messenger from '../../helpers/Messenger';
    import Moment from 'moment';
    import Errors from '../../helpers/Errors';

    export default {
        data() {
            return {
                profile: null,
                systems: [],
                languages: [],
                types: [],
                fetching: false,
                Errors: new Errors(),
            };
        },
        computed: {
            ...mapGetters(['user'])
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.fetching = true;

                const fetchProfile = this.$http.get(`/profile/${this.user.id}`);
                const fetchSystems = this.$http.get(`/systems`);
                const fetchLanguages = this.$http.get(`/languages`);
                const fetchTypes = this.$http.get(`/types`);

                Promise.all([fetchProfile, fetchSystems, fetchLanguages, fetchTypes])
                    .then(([profileRes, systemRes, langRes, typeRes] ) => {
                        this.profile = profileRes.data;
                        this.systems = systemRes.data;
                        this.languages = langRes.data;
                        this.types = typeRes.data;

                        this.profile.birth_date = new Date(this.profile.birth_date);
                    })
                    .catch(() => {
                        Messenger.error('Could not load data');
                    })
                    .finally(() => {this.fetching = false;});
            },
            updateProfile() {
                this.fetching = true;

                const profile  = { ...this.profile };
                profile.birth_date = Moment(this.profile.birth_date).format('YYYY-MM-DD');

                this.$http.put(`/profile/${this.user.id}`, profile)
                    .then(() => {
                        Messenger.success('Your profile has been updated successfully');
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
                    .finally(() => {
                        this.fetching = false;
                    });
            },
            dateFormatter(date) {
                return Moment(date).format('YYYY-MM-DD')
            },
        }
    }
</script>
