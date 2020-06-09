<template>
    <div class="container">
        <nav class="breadcrumb has-arrow-separator">
            <ul>
                <li>
                    <router-link :to="{ name: 'admin' }">Admin</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'admin.systems' }">Systems</router-link>
                </li>
                <li class="is-active">
                    <a>List</a>
                </li>
            </ul>
        </nav>
        <div v-if="!fetching">
            <b-table
                :data="systems"
                class="mb-20"
                hoverable>
                <template slot-scope="props">
                    <b-table-column field="id" label="ID" width="40" numeric>
                        {{ props.row.id }}
                    </b-table-column>
                    <b-table-column field="name" label="Name">
                        {{ props.row.name }}
                    </b-table-column>
                    <b-table-column field="description" label="Description">
                        {{ props.row.description }}
                    </b-table-column>
                    <b-table-column label="Actions">
                        <b-button type="is-info" size="is-small" @click="edit(props.row.id)">
                            <b-icon icon="pen"></b-icon>
                        </b-button>
                        <b-button type="is-danger" size="is-small" @click="remove(props.row.id)">
                            <b-icon icon="trash-alt"></b-icon>
                        </b-button>
                    </b-table-column>
                </template>
            </b-table>
            <b-button class="button is-primary" @click="create">
                Add system
            </b-button>
            <button class="button is-info" @click="fetchData">
                <b-icon
                    icon="sync">
                </b-icon>
                <span>Refresh</span>
            </button>
        </div>
        <b-loading :is-full-page="false" :active.sync="fetching"></b-loading>
        <b-modal :active.sync="creating"
                 trap-focus
                 has-modal-card
                 :destroy-on-hide="false">
            <create-system-modal v-on:created="handleCreate"></create-system-modal>
        </b-modal>
        <b-modal :active.sync="editing"
                 trap-focus
                 has-modal-card
                 :destroy-on-hide="false">
            <edit-system-modal :id="systemId" v-on:updated="handleUpdate"></edit-system-modal>
        </b-modal>
    </div>
</template>

<script>
    import Messenger from '../../helpers/Messenger';
    import CreateSystemModal from '../../components/admin/CreateSystemModal';
    import EditSystemModal from '../../components/admin/EditSystemModal';

    export default {
        components: {
            CreateSystemModal,
            EditSystemModal
        },
        data() {
            return {
                fetching: false,
                creating: false,
                editing: false,
                systemId: null,
                systems: [],
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.fetching = true;
                this.$http.get(`/systems`)
                    .then(({data}) => {
                        this.systems = data;
                    })
                    .catch(() => {
                        Messenger.error('Could not load data');
                    })
                    .finally(() => this.fetching = false);
            },
            handleCreate() {
                this.fetchData();
            },
            handleUpdate() {
                this.fetchData();
            },
            create() {
                this.creating = true;
            },
            edit(id) {
                this.systemId = id;
                this.editing = true;
            },
            remove(id) {
                this.fetching = true;
                this.$http.delete(`/systems/${id}`)
                    .then(() => {
                        Messenger.success('System removed successfully');
                    })
                    .then(() => {
                        this.fetchData();
                    })
                    .catch(() => {
                        Messenger.error('Something went wrong, try again');
                    })
                    .finally(() => this.fetching = false );
            }
        }
    }
</script>
