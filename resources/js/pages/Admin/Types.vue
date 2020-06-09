<template>
    <div class="container">
        <nav class="breadcrumb has-arrow-separator">
            <ul>
                <li>
                    <router-link :to="{ name: 'admin' }">Admin</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'admin.types' }">Types</router-link>
                </li>
                <li class="is-active">
                    <a>List</a>
                </li>
            </ul>
        </nav>
        <div v-if="!fetching">
            <b-table
                :data="types"
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
                Add type
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
            <create-type-modal v-on:created="handleCreate"></create-type-modal>
        </b-modal>
        <b-modal :active.sync="editing"
                 trap-focus
                 has-modal-card
                 :destroy-on-hide="false">
            <edit-type-modal :id="typeId" v-on:updated="handleUpdate"></edit-type-modal>
        </b-modal>
    </div>
</template>

<script>
    import Messenger from '../../helpers/Messenger';
    import CreateTypeModal from '../../components/admin/CreateTypeModal';
    import EditTypeModal from '../../components/admin/EditTypeModal';

    export default {
        components: {
            CreateTypeModal,
            EditTypeModal
        },
        data() {
            return {
                fetching: false,
                creating: false,
                editing: false,
                typeId: null,
                types: [],
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.fetching = true;
                this.$http.get(`/types`)
                    .then(({data}) => {
                        this.types = data;
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
                this.typeId = id;
                this.editing = true;
            },
            remove(id) {
                this.fetching = true;
                this.$http.delete(`/types/${id}`)
                    .then(() => {
                        Messenger.success('Type removed successfully');
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
